<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
class OrderController extends Controller
{
    //
    public function create(CartRepository $cart)
    {
        if($cart->get()->isEmpty()){
            return redirect()->route('home');
        }
        return view('front.checkout',[
            'cart'=>$cart,
            'countries'=>Countries::getNames('en'),
        ]);
    }


    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);


        $items=$cart->get()->groupBy('product.store_id')->all();
        //امكانية استخدام العلاقات بين المودل داخل groupBy
        DB::beginTransaction();//اما كل عمليات الانشاء او لا احد
        //
        try {
            foreach ($items as $store_id=>$cart_items){}
            $order=Order::create([
                'store_id'=>$store_id,
                'user_id'=>Auth::id(),
                'payment_method'=>'cod',
            ]);
            //عملية انشاء الاوردر بجدول منفصل
            foreach ($cart_items as $item){
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->product_id,
                    'quantity'=>$item->quantity,
                    'price'=>$item->product->price,
                    'product_name'=>$item->product->name,
                ]);
                //ادخال التفاصيل الخاصة بالاوردر بشكل منفصل

            }
            foreach ($request->post('addr') as $type=>$address)
            //استقبال البيانات على شكل array
            {
                $address['type']=$type;
                $order->addresses()->create($address);
                //استغلال العلقة بين الاوردر والادريس لانشاءسريع للادريس
                /*
                 الان في الفورم addr عبارة عن مصفوفة جوا مصفوفة مصفوفة ل بيلينج واخرى ل شيبنغ
                هو لف على هدول المصفوفتين وفي كل مصفوفة في مصفوفة داخلها تحتوي على بيانات
                 احنا عملنا ادخال لهذه البيانات
                 */

            }
//            $cart->empty();
            DB::commit();
//            event('order.created',$order,Auth::user());
            event(new OrderCreated($order,Auth::user()));
        }catch (Throwable $e){
            DB::rollBack();
            throw $e;
        }
//return redirect()->route('home');
    }
}

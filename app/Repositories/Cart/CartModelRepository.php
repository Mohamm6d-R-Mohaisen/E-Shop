<?php
namespace App\Repositories\Cart;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;



class CartModelRepository implements CartRepository
{
    protected $item;
    public function __construct()
    {
        $this->item=collect([]);
        //convert the array to collection
    }
public function get(): Collection
{
if(!$this->item->count()){
  $this->item= Cart::with('product')->get();
}
return $this->item;
}
public function add(Product $product,$quantity =1){


$items=Cart::where('product_id','=',$product->id)
//    ->where('cookie_id','=',$this->getCookieId())
    ->first();
if(!$items) {
   $cart= Cart::create([
//        'cookie_id' => $this->getCookieId(),
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => $quantity,
    ]);
    $this->get()->push($cart);
    //to add in item collection
    return $cart;
}
$items->increment('quantity',$quantity);

}
public function update($id, $quantity)
{
    return Cart::where('id','=',$id)
//    ->where('cookie_id','=',$this->getCookieId())
    ->update([
        'quantity'=>$quantity,

    ]);
}
public function delete($id)
{
    return Cart::where('id','=',$id)->delete();

}

public function empty()
{
    Cart::query()->delete();
}
public function totale():float
{
//    return (float)Cart::
////    where('cookie_id','=',$this->getCookieId()) ->
//   join('products','products.id','=','carts.product_id')
//    ->selectRaw('SUM(products.price * carts.quantity) as totale')
//    ->value('totale');



    return $this->get()->sum(function($item) {
        return $item->quantity * $item->product->price;
    });
}




//protected function getCookieId()
//{
//
//    $cookie_id = Cookie::get('cart_id');//يجلب الكوكي الخاص بالمستخدم ويسيميه
//    if (!$cookie_id) {
//        $cookie_id = Str::uuid();//انشاء كوكي من خلال Str
//        Cookie::queue('cart_id', $cookie_id, 30 * 60 * 24);
//        //يتم حفظ الكوكي داخل كيو لسهول الوصول اليه
//
//    }
//    return $cookie_id;
//}

}

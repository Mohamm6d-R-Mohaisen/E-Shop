<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        //
//        foreach (Cart::get() as $item){
//            Product::where('id','=',$item->product_id)
//                ->decrement('quantity',$item->quantity);
//        }
//        $order=$event->order;
//        foreach ($order->products as $product){
//            $product->decrement('quantity',$product->pivot->quantity);
//        }
    }
}

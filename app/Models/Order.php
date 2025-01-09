<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['number'];
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_items',
            'order_id','product_id','id','id')
            ->using(OrderItem::class)
            ->withPivot('quantity','price','product_name','options');
    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function bilingAddress()
    {
        return $this->hasOne(OrderAddress::class,)
            ->where('type','=','billing');
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class,)
            ->where('type','=','shipping');
    }



    public function user(){
        return $this->belongsTo(User::class)->withDefault(
            [
                'name'=>'Guest Customer'
            ]
        );
    }
    protected static function booted(){
        static::creating(function(Order $order){
            $order->number=self::getNextNumber();
        });
    }
    public static function getNextNumber(){
        $year=Carbon::now()->year;
        $number=Order::whereYear('created_at',$year)->max('number');
        if($number){
          return  $number +1;
        }
        return $year.'00001';

    }


}

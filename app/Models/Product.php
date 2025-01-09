<?php

namespace App\Models;


use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable=['name','slug','description','price','image','category_id','store_id','compare_price','status'];


    public function categary(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tags::class,'product_tag',
            'product_id','tag_id','id','id');
    }



    protected static function booted()
    {

     static::addGlobalScope('store', new StoreScope);

    }
    public function scopeactive(Builder $builder)
    {
        $builder->where('status','=','active');
    }
    //Accessors
    public function getImageUrlAttribute()
    {
      if(!$this->image){
          return '';
      }
      if(Str::startsWith($this->image,['http','https'])){
          return $this->image;
      }
      return asset( 'storage/'.$this->image);
    }
    public function getSalePercentAttribute()
    {
        if(!$this->compare_price) {
            return 0;
        }
        return number_format( 100-(100 * $this->price /$this->compare_price),0);
    }
}

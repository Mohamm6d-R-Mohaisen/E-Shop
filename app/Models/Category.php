<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    public $incrementing=true;
    public $timestamps=true;


    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')
            ->withDefault( ['name'=>'-']);
    }
    public function childrens(){
        return $this->hasMany(Category::class,'parent_id','id');
    }


    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }
    public function scopeFilters(Builder $builder,$filters){
        if($filters['name']?? false){
            $builder->where('name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status']?? false){
            $builder->where('status','=',"{$filters['status']}");
        }
    }


    protected $guarded=[];
    public static function rules($id=0 ){
        return[
            'name'=>['require','string','min:5','max:255',
                // "unique:ccatogary,name,$id",
                Rule::unique('catogary','name')->ignore($id)
            ],
            'parent_id'=>['nullable','int','exists:catogaries,id'],
            'image'=>['image','max:102444000','dimentions:min_width=100,min_heigth=100'],
            'status'=>['in:active,archived']
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function getnameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }
    public function getCountryNameAttribute()
    {
        return Countries::getName($this->country);
    }
}

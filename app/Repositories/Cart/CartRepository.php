<?php
namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
public function get():Collection;
public function add(Product $product, $quantity=1);
public function update($id,$quantity);
public function delete($id);
public function totale();
public function empty();

}
//اي كلاس بيعمل implementing
//للكلاس هاد يجب ان يحتوي على جميع الميتود الموجودة هنا

<?php

use App\Http\Controllers\Dashboard\CategariesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;





Route::group([
    'middleware'=>['auth.type:admin,super-admin','auth'],


    //ارسال قيم للميديل وير

    'as'=>'dashboard.',//to name
    'prefix'=>'dashboard'//to route
],function(){


Route::get('/', [DashboardController::class,'index'])
->name('dashboard');
Route::get('catogaries/trash',[CategariesController::class,'trash'])
->name('catogaries.trash');
Route::put('catogaries/{catogary}/restore',[CategariesController::class,'restore'])
->name('catogaries.restore');
Route::delete('catogaries/{catogary}/force-delete',[CategariesController::class,'forcedelete'])
->name('catogaries.forcedelete');



Route::resource('catogaries',CategariesController::class);
Route::resource('products',ProductController::class);


});



Route::get('dashboard/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
Route::patch('dashboard/profile/update',[ProfileController::class,'update'])->name('profile.update');
//تنشا 7 راوت  نفسهم الي في ريسورس كونترولر

?>

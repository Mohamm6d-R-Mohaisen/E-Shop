    <?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
    use App\Http\Controllers\Front\OrderController;
    use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/product',[ProductController::class,'index'])
    ->name('product.index');
Route::get('/product/{product:slug}',[ProductController::class,'show'])
    ->name('product.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('cart',CartController::class);

Route::get('checkout',[OrderController::class,'create'])->name('checkout');
Route::post('checkout',[OrderController::class,'store']);

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

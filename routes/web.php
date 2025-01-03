<?php


use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/user/{id}', function (string $id) { return 'User '.$id;
});

/*
*
*
*
*
*
*
*/

/*Route Products*/



// เส้นทางสำหรับแสดงรายการสินค้าทั้งหมด
 Route::get('/products', [ProductController::class, 'index'])->name('products.index')
 ->middleware(['auth', 'verified']);  // กำหนด middleware


// เส้นทางสำหรับแสดงรายละเอียดของสินค้าแต่ละตัวตาม ID
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')
    // กำหนด middlewar
    ->middleware(['auth', 'verified']);




/*
*
*
*
*
*
*
*/


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';

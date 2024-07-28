<?php

use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//original route
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'adminAuth'])->group(function () {

    Route::get('/dashboard',[AuthController::class, 'dashboard'])->name("dashboard");

    Route::prefix('admin')->group(function () {
        Route::prefix('category')->group(function() {
            Route::get('list', [CategoryController::class, 'list'])->name('category.list');
            Route::post('create', [CategoryController::class, 'create'])->name('category.create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::get('edit/{id}', [CategoryController::class, 'editPage'])->name('category.editPage');
            Route::post('edit', [CategoryController::class, 'edit'])->name('category.edit');
        });
    });

});


Route::middleware(['auth', 'verified', 'userAuth'])->group(function () {

    Route::get('/home', [AuthController::class,'homePage'])->name('user#home');

});

// Route::get('/home', [AuthController::class,'homePage'])->name('user#home');



// login , register
Route::middleware('adminAuth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');

    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});



require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.main');
});
Route::get('/menu', [HomeController::class, 'menu']);
Route::get('/terms', function () {
    return view('pages.terms');
});
Route::get('/laws', function () {
    return view('pages.lawspage');
});
Route::get('/coffebuy', function () {
    return view('pages.coffesell');
});
Route::get('/diet', function () {
    return view('pages.dietpage');
});
Route::get('/learn', function () {
    return view('pages.learnpage');
});
Route::get('/aboutus', function () {
    return view('pages.aboutuspage');
});
Route::get('/login', function () {
    return view('pages.userlogin');
});
Route::get('/forgot', function () {
    return view('pages.forgotpassword');
});
Route::get('/register', function () {
    return view('pages.register');
});
Route::get('/payment', function () {
    return view('payment');
});
// Route::get('/dash', function () {
//     return view('pages.dashboardpage');
// });


// Route::get('/add_food', [AdminController::class,'add_food']);

// Route::post('/upload_food', [AdminController::class,'upload_food']);

// Route::get('/view_food', [AdminController::class,'view_food']);

// Route::get('/delete_food/{id}', [AdminController::class,'delete_food']);

// Route::get('/update_food/{id}', [AdminController::class,'update_food']);

// Route::post('/edit_food/{id}', [AdminController::class,'edit_food']);


Route::prefix('dash')->group(function () {
    // Routes that require only authentication
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            if (Auth::user()->role === 'user') {
                $orders = \App\Models\Order::where('email', Auth::user()->email)
                            ->orderBy('created_at', 'desc')
                            ->get();
                return view('pages.dashboardpage', ['orders' => $orders]);
            } else {
                $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
                return view('pages.dashboardpage', ['orders' => $orders]);
            }
        });

        // user info routes
        Route::get('/user-info', [AdminController::class, 'userInfo'])->name('admin.user_info');
        Route::post('/update-user-info', [AdminController::class, 'updateUserInfo'])->name('admin.update_user_info');

        // User-specific routes
        Route::get('/cancel-user-order/{id}', [AdminController::class, 'cancelUserOrder'])
            ->name('cancel.user.order');
        Route::get('/user-orders', [AdminController::class, 'userOrders'])
            ->name('user.orders');
    });

    // Routes that require both authentication and admin role
    Route::middleware(['auth', 'admin'])->group(function () {
        // Food management
        Route::get('/add_food', [AdminController::class, 'add_food']);
        Route::post('/upload_food', [AdminController::class, 'upload_food']);
        Route::get('/view_food', [AdminController::class, 'view_food']);
        Route::get('/delete_food/{id}', [AdminController::class, 'delete_food']);
        Route::get('/update_food/{id}', [AdminController::class, 'update_food']);
        Route::post('/edit_food/{id}', [AdminController::class, 'edit_food']);
        Route::post('/upload_item', [AdminController::class, 'upload_item']);

        // Order management
        Route::get('/orders', [AdminController::class,'orders']);
        Route::get('on_the_way/{id}', [AdminController::class,'on_the_way']);
        Route::get('delivered/{id}', [AdminController::class,'delivered']);
        Route::get('canceled/{id}', [AdminController::class,'canceled']);

        // User management
        Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);
        Route::get('/edit_user/{id}', [AdminController::class, 'edit_user']);
        Route::post('/update_user/{id}', [AdminController::class, 'update_user']);
        Route::get('/user_list', [AdminController::class, 'user_list']);

        // Doctor consultations
        Route::get('/doctor', [AdminController::class, 'doctorConsultations'])
            ->name('admin.doctor');

        // Gallery management
        Route::post('/upload_gal', [AdminController::class, 'upload_gal'])
            ->name('admin.upload_gal');

        // Gallery management
        Route::get('/delete_gallery/{id}', [AdminController::class, 'delete_gallery'])
            ->name('admin.delete_gallery');

        // Add this new route
        Route::get('/delete-order/{id}', [AdminController::class, 'deleteOrder'])
            ->name('admin.delete_order');
    });
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/addcart', [HomeController::class, 'my_cart'])->name('addcart')->middleware('auth');
Route::post('/add-cart/{id}', [HomeController::class, 'add_cart'])
    ->name('add.cart')
    ->middleware('web');
Route::get('/remove-cart/{id}', [HomeController::class, 'remove_cart'])->name('remove.cart');
Route::post('/confirm-order', [HomeController::class, 'confirm_order'])
    ->name('confirm.order')
    ->middleware('auth');
Route::post('/add-coffee-cart/{id}', [HomeController::class, 'add_coffee_cart'])
    ->name('add.coffee.cart')
    ->middleware('web');

Route::post('/consultation', [HomeController::class, 'storeConsultation'])->name('consultation.store');

Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update.cart');

Route::get('/get-cart-items', [HomeController::class, 'getCartItems']);
Route::get('/get-coffee-cart-items', [HomeController::class, 'getCoffeeCartItems']);
Route::get('/remove-coffee-cart/{id}', [HomeController::class, 'removeCoffeeCart'])->name('remove.coffee.cart');

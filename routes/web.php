<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomePageController,
    RegisterPageController,
    LoginPageController,
    CatalogPageController,
    ProductDetailsPageController,
    CartPageController,
    CheckoutPageController,
    OrdersPageController,
    ProfilePageController,
    PaluwaganPageController,
    AdminDashboardController,
    AdminOrdersController,
    AdminSalesReportController,
    AdminUsersController,
    AdminPaluwaganController,
    AdminInventoryController
};

// ------------------- USER PAGES -------------------
Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::get('/register', [RegisterPageController::class, 'show'])->name('register');
Route::post('/register', [RegisterPageController::class, 'store'])->name('register.store');
Route::post('/check-username', [RegisterPageController::class, 'checkUsername']);

Route::get('/login', [LoginPageController::class, 'index'])->name('login');
Route::post('/login', [LoginPageController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginPageController::class, 'logout'])->name('logout');
<<<<<<< Updated upstream

Route::post('/check-username', [RegisterPageController::class, 'checkUsername']);
=======
>>>>>>> Stashed changes

Route::get('/catalog', [CatalogPageController::class, 'index'])->name('catalog');

<<<<<<< Updated upstream
=======
// Cart
>>>>>>> Stashed changes
Route::get('/cart', [CartPageController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartPageController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartPageController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartPageController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartPageController::class, 'update'])->name('cart.update');

Route::get('/checkout', [CheckoutPageController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutPageController::class, 'placeOrder'])->name('checkout.placeOrder');

// Orders
Route::get('/orders', [OrdersPageController::class, 'index'])->name('orders.index');

Route::get('/profile', function () {
    return view('user.ProfilePage');
})->name('profile');

// ------------------- PALUWAGAN -------------------
Route::get('/paluwagan', [PaluwaganPageController::class, 'index'])->name('paluwagan');
Route::post('/paluwagan/join', [PaluwaganPageController::class, 'join'])->name('paluwagan.join');

// ------------------- ADMIN PAGES -------------------
Route::prefix('admin')->group(function() {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
<<<<<<< Updated upstream
    Route::patch('/admin/users/toggle-status/{userID}', [AdminUsersController::class, 'toggleStatus'])->name('admin.users.toggleStatus');



    Route::get('/orders', [AdminOrdersController::class, 'index'])->name('admin.orders');
    Route::get('/salesreport', [AdminSalesReportController::class, 'index'])->name('admin.salesreport');
=======

    // Orders & Sales
    Route::get('/orders', [AdminOrdersController::class, 'index'])->name('admin.orders');
    Route::get('/salesreport', [AdminSalesReportController::class, 'index'])->name('admin.salesreport');

    // Users
>>>>>>> Stashed changes
    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}', [AdminUsersController::class, 'show'])->name('admin.users.show');
    Route::post('/users/create-admin', [AdminUsersController::class, 'storeAdmin'])->name('admin.users.storeAdmin');
    // Optional routes for future enhancements
    Route::post('/users/{id}/update-status', [AdminUsersController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::post('/users/{id}/change-role', [AdminUsersController::class, 'changeRole'])->name('admin.users.changeRole');
    Route::delete('/users/{id}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

    // Paluwagan
    Route::get('/paluwagan', [AdminPaluwaganController::class, 'index'])->name('admin.paluwagan');

<<<<<<< Updated upstream
    // Inventory Routes
=======
    // Inventory
>>>>>>> Stashed changes
    Route::get('/inventory', [AdminInventoryController::class, 'index'])->name('admin.inventory');

    // POST route for adding ingredients (fetch/JSON)
    Route::post('/inventory/store', [AdminInventoryController::class, 'store'])->name('inventory.store');

    // PUT route for editing ingredients (fetch/JSON)
    Route::put('/inventory/{id}', [AdminInventoryController::class, 'update'])->name('inventory.update');
});

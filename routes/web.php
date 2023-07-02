<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CreditInvoicePurchaseItemController;

//use App\Http\Controllers\CustomerController;
//use App\Http\Controllers\LevelController;
//use App\Http\Controllers\NotificationController;


use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIInsertDataFix;
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

//Authorization controllers
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('password/change', [AuthController::class, 'showChangeForm'])->name('password.change');
Route::post('password/change', [AuthController::class, 'changePassword'])->name('password.update');
Route::get('password/reset', [AuthController::class, 'showResetForm'])->name('questions.check');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('/level2', [AuthController::class, 'level2']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/level3', [AuthController::class, 'level3'])->name('level3');

//Level 2
Route::get('/dropdown/truck1', [TruckController::class, 'truck1'])->name('truck1');
Route::get('/dropdown/truck2', [TruckController::class, 'truck2'])->name('truck2');
Route::get('/dropdown/truck3', [TruckController::class, 'truck3'])->name('truck3');
Route::get('/dropdown/truck4', [TruckController::class, 'truck4'])->name('truck4');
Route::get('/dropdown/truck5', [TruckController::class, 'truck5'])->name('truck5');

//Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'view'])->name('profile');
Route::match(['get', 'post'], '/profile/password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('password');
Route::match(['get', 'post'], '/profile/username', [App\Http\Controllers\ProfileController::class, 'changeUsername'])->name('username');
Route::match(['get', 'post'], '/profile/email', [App\Http\Controllers\ProfileController::class, 'changeEmail'])->name('email');

// Admin Controllers
Route::middleware(['web', 'role:admin'])->get('/routes', [RouteController::class, 'index']);
Route::resource('/users', UserController::class);






Route::post('authorization/cookie', [AuthorizationController::class, 'cookieAuthorization']);
Route::post('authorization/token', [AuthorizationController::class, 'tokenAuthorization']);
Route::post('unauthorization', [AuthorizationController::class, 'logout']);
Route::get('/preorder/{preOrderId}', [PreOrderController::class, 'getPreOrder']);
Route::put('/preorder', [PreOrderController::class, 'updateOrCreatePreOrder']);
Route::get('/preorderdate/{date}/{debtorId}', [PreOrderController::class, 'getPreOrderByDateAndDebtor']);
Route::get('purchase', [PurchaseController::class, 'index']);
Route::get('purchase/{id}', [PurchaseController::class, 'show']);
Route::get('articles', [ArticleController::class, 'getData']);
Route::get('PurchaseSinceDate/{date}', [PurchaseController::class, 'purchasesSinceDate']);
Route::get('PurchaseSinceChangeDate/{dateFrom}/{dateTo?}', [PurchaseController::class, 'purchasesSinceChangeDate']);
Route::get('purchase/stock', [PurchaseController::class, 'stock']);
Route::get('CreditInvoicePurchaseItem', [CreditInvoicePurchaseItemController::class, 'index']);
Route::get('CreditInvoicePurchaseItem/{id}', [CreditInvoicePurchaseItemController::class, 'show']);
Route::get('CreditInvoicePurchaseItemSinceDate/{id}/{date}', [CreditInvoicePurchaseItemController::class, 'showSinceDate']);
Route::get('apiCustomers',[APIInsertDataFix::class, 'storeCustomer'])->name('APIInsertDataFix.storeCustomer');

Route::get('/notifications', [NotificationController::class, 'InvoiceNotification']);
Route::get('/notifications/{id}/read', [NotificationController::class, 'ReadNotification'])->name('notification.read');

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Dashboards\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Order\DueOrderController;
use App\Http\Controllers\Order\OrderCompleteController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\OrderPendingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductExportController;
use App\Http\Controllers\Product\ProductImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('php/', function () {
    return phpinfo();
});
Route::get('/', function () {
    return view('landing');
})->name('landing');


// Simple health check endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'service' => 'Laravel App'
    ]);
});

// Basic root endpoint
Route::get('/health', function () {
    return response()->json([
        'message' => 'Laravel is running!',
        'timestamp' => now()->toISOString()
    ]);
});



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard/', [DashboardController::class, 'index'])->name('dashboard');


    // // User Management
    // Route::resource('/users', UserController::class);
    Route::put('/user/change-password/{username}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::get('/profile/store-settings', [ProfileController::class, 'store_settings'])->name('profile.store.settings');
    Route::post('/profile/store-settings', [ProfileController::class, 'store_settings_store'])->name('profile.store.settings.store');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route orders - require manage-orders permission
    Route::middleware(['permission:manage-orders'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/pending', OrderPendingController::class)->name('orders.pending');
        Route::get('/orders/complete', OrderCompleteController::class)->name('orders.complete');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/search-products', [OrderController::class, 'searchProducts'])->name('orders.searchProducts');
    });

    // Reports - require view-reports permission
    Route::middleware(['permission:view-reports'])->group(function () {
        Route::get('/orders/report', [OrderController::class, 'salesReport'])->name('orders.salesReport');
        Route::post('/orders/report/export', [OrderController::class, 'exportSalesReport'])->name('orders.exportSalesReport');
        Route::post('/order-report', [OrderController::class, 'exportSalesReport'])->name('orders.getSalesReport');
        Route::get('/sales-report/monthly', [OrderController::class, 'getMonthlySalesReport'])->name('orders.getMonthlySalesReport');
        Route::get('/sales-report/export-pdf', [OrderController::class, 'exportMonthlySalesReport'])->name('orders.exportSalesReportAsPDF');
    });

    // Quotations - require manage-quotations permission
    Route::middleware(['permission:manage-quotations'])->group(function () {
        Route::get('/quotations/mobile', [QuotationController::class, 'mobileIndex'])->name('quotations.mobile');
        Route::resource('/quotations', QuotationController::class);
        Route::post('/quotations/complete/{quotation}', [QuotationController::class, 'update'])->name('quotations.complete');
        Route::delete('/quotations/delete/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.delete');
    });

    // Customers - require manage-customers permission
    Route::middleware(['permission:manage-customers'])->group(function () {
        Route::resource('/customers', CustomerController::class);
    });

    // Suppliers - require manage-suppliers permission
    Route::middleware(['permission:manage-suppliers'])->group(function () {
        Route::resource('/suppliers', SupplierController::class);
    });

    // Categories - require manage-categories permission
    Route::middleware(['permission:manage-categories'])->group(function () {
        Route::resource('/categories', CategoryController::class);
    });

    // Units - require manage-units permission
    Route::middleware(['permission:manage-units'])->group(function () {
        Route::resource('/units', UnitController::class);
    });

    // Products - require manage-products permission
    Route::middleware(['permission:manage-products'])->group(function () {
        Route::get('products/import/', [ProductImportController::class, 'create'])->name('products.import.view');
        Route::post('products/import/', [ProductImportController::class, 'store'])->name('products.import.store');
        Route::get('/products/export-pdf', [ProductExportController::class, 'exportProductsAsPDF'])->name('products.export.store');
        Route::get('/products/mobile', [ProductController::class, 'mobileIndex'])->name('products.mobile');
        Route::resource('/products', ProductController::class);
    });

    // Route POS
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/cart/add', [PosController::class, 'addCartItem'])->name('pos.addCartItem');
    Route::post('/pos/cart/update/{rowId}', [PosController::class, 'updateCartItem'])->name('pos.updateCartItem');
    Route::delete('/pos/cart/delete/{rowId}', [PosController::class, 'deleteCartItem'])->name('pos.deleteCartItem');

    //Route::post('/pos/invoice', [PosController::class, 'createInvoice'])->name('pos.createInvoice');
    Route::get('invoice/create/', [InvoiceController::class, 'showCreateForm'])->name('invoice.create');
    Route::post('invoice/create/', [InvoiceController::class, 'create']);

    // SHOW ORDER
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');

    // DUES
    Route::get('due/orders/', [DueOrderController::class, 'index'])->name('due.index');
    Route::get('due/order/view/{order}', [DueOrderController::class, 'show'])->name('due.show');
    Route::get('due/order/edit/{order}', [DueOrderController::class, 'edit'])->name('due.edit');
    Route::put('due/order/update/{order}', [DueOrderController::class, 'update'])->name('due.update');

    // TODO: Remove from OrderController
    Route::get('/orders/details/{order_id}/download', [OrderController::class, 'downloadInvoice'])->name('orders.downloadInvoice');


    // Purchase Reports - require view-reports permission (moved before parameterized routes)
    Route::middleware(['permission:view-reports'])->group(function () {
        Route::get('/purchases/report', [PurchaseController::class, 'purchaseReport'])->name('purchases.purchaseReport');
        Route::post('/purchases/report/export', [PurchaseController::class, 'exportPurchaseReport'])->name('purchases.exportPurchaseReport');
        Route::post('/purchases/report', [PurchaseController::class, 'exportPDFPurchaseReport'])->name('purchases.exportPDFPurchaseReport');
        Route::post('/purchase-report', [PurchaseController::class, 'exportPurchaseReport'])->name('purchases.getPurchaseReport');
    });

    // Purchases - require manage-purchases permission
    Route::middleware(['permission:manage-purchases'])->group(function () {
        Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/purchases/mobile', [PurchaseController::class, 'mobileIndex'])->name('purchases.mobile');
        Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
        Route::get('/purchases/approved', [PurchaseController::class, 'approvedPurchases'])->name('purchases.approvedPurchases');
        Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
        Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
        Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
        Route::post('/purchases/update/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
        Route::delete('/purchases/delete/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.delete');
    });


});


Route::group(['middleware' => ['role:super-admin|admin']], function () {

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.add-permissions');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.give-permissions');

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
    
    // User Role Management
    Route::get('user-roles', [App\Http\Controllers\UserRoleController::class, 'index'])->name('users.roles');
    Route::post('users/{user}/assign-role', [App\Http\Controllers\UserRoleController::class, 'assignRole'])->name('users.assign-role');
    Route::delete('users/{user}/remove-role', [App\Http\Controllers\UserRoleController::class, 'removeRole'])->name('users.remove-role');
});

require __DIR__ . '/auth.php';

Route::get('test/', function () {
    return view('test');
});

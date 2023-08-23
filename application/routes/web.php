<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


//Frontend
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'Index')->name('index');
    Route::get('/categories', 'Categories')->name('categories');
    Route::get('/categories/{category_slug}', 'Products')->name('products');
    Route::get('/categories/{category_slug}/{product_slug}', 'ProductView')->name('productView');
    Route::get('/thank-you', 'ThankYou')->name('thank-you');
    Route::get('/terms', 'TermsService')->name('terms');
    Route::get('/privacy', 'PrivacyPolicy')->name('privacy');
});

Route::middleware(['auth'])->group(function () {
    //Wishlist
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'Wishlist')->name('wishlist');
    });

    //Cart
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'Cart')->name('cart');
        // Route::get('/checkout', 'Checkout')->name('checkout');
    });

    //Checkout
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'Checkout')->name('checkout');
    });

    //UserOrders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/user/orders', 'Orders')->name('user.orders');
        Route::get('/completed/order/list', 'CompletedOrderList')->name('completed.order.list');
        Route::get('/orders/{id}', 'OrderShow')->name('orders.show');
        Route::put('/orders/cancel/{id}', 'CancelOrder')->name('cancel.order');
        Route::get('request/return/{id}', 'RequestReturn');
    });

    //Profile
    Route::controller(FrontendUserController::class)->group(function () {
        Route::get('/profile', 'Profile')->name('profile');
        Route::post('/profile/update', 'ProfileUpdate')->name('profile.update');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/change/password/store', 'ChangePasswordStore')->name('change.passwordstore');
    });
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // Route::get('dashboard', [DashboardController::class, 'index']);
    // Route::get('/notification/minimum/mail', [DashboardController::class, 'NotificationMinimumMail']);

    //Supplier
    Route::controller(SupplierController::class)->group(function () {
        // Route::get('/supplier', 'SupplierAll')->name('supplier');
        Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
        Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
    });


    //Unit
    Route::controller(UnitController::class)->group(function () {
        // Route::get('/unit', 'UnitAll')->name('unit');
        Route::get('/unit/add', 'UnitAdd')->name('unit.add');
        Route::post('/unit/store', 'UnitStore')->name('unit.store');
        Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
        Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
        Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');
    });

    //Category
    Route::controller(CategoryController::class)->group(function () {
        // Route::get('/category', 'CategoryAll')->name('category');
        Route::get('/category/add', 'CategoryAdd')->name('category.add');
        Route::post('/category/store', 'CategoryStore')->name('category.store');
        Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
        Route::post('/category/update', 'CategoryUpdate')->name('category.update');
        Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
    });

    //Brands
    Route::controller(BrandController::class)->group(function () {
        // Route::get('/brand', 'BrandAll')->name('brand');
        Route::get('/brand/add', 'BrandAdd')->name('brand.add');
        Route::post('/brand/store', 'BrandStore')->name('brand.store');
        Route::get('/brand/edit/{id}', 'BrandEdit')->name('brand.edit');
        Route::post('/brand/update', 'BrandUpdate')->name('brand.update');
        Route::get('/brand/delete/{id}', 'BrandDelete')->name('brand.delete');
    });

    //Products
    Route::controller(ProductController::class)->group(function () {
        // Route::get('/product', 'ProductAll')->name('product');
        Route::get('/product/add', 'ProductAdd')->name('product.add');
        Route::post('/product/store', 'ProductStore')->name('product.store');
        Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
        Route::post('/product/update', 'ProductUpdate')->name('product.update');
        Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');
    });
    //Purchase
    Route::controller(PurchaseController::class)->group(function () {
        // Route::get('/purchase', 'PurchaseAll')->name('purchase');
        // Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
        // Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
        // Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
        Route::get('/purchase/view', 'PurchaseView')->name('purchase.view');
        // Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
        Route::get('/purchase/approval/{id}', 'PurchaseApproval')->name('purchase.approval');
        Route::post('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
        Route::get('/purchase/reorder/{id}', 'PurchaseReorder')->name('purchase.reorder');
    });

    // //Defaults
    // Route::controller(DefaultController::class)->group(function () {
    //     Route::get('/get-brand', 'GetBrand')->name('get-brand');
    //     Route::get('/get-category', 'GetCategory')->name('get-category');
    //     Route::get('/get-product', 'GetProduct')->name('get-product');
    //     Route::get('/get-product-category', 'GetProductCategory')->name('get-product-category');
    // });

    // //Slider
    // Route::controller(SliderController::class)->group(function () {
    //     Route::get('/slider', 'SliderAll')->name('slider');
    //     Route::get('/slider/add', 'SliderAdd')->name('slider.add');
    //     Route::post('/slider/store', 'SliderStore')->name('slider.store');
    //     Route::get('/slider/edit/{id}', 'SliderEdit')->name('slider.edit');
    //     Route::post('/slider/update', 'SliderUpdate')->name('slider.update');
    //     Route::get('/slider/delete/{id}', 'SliderDelete')->name('slider.delete');
    // });

    // //Orders
    // Route::controller(AdminOrderController::class)->group(function () {
    //     Route::get('/orders', 'Orders')->name('orders');
    //     Route::get('/orders/{orderId}', 'OrderShow')->name('orders.view');
    //     Route::get('/filter', 'FilterOrder')->name('filter.order');
    //     Route::put('/orders/{orderId}', 'UpdateOrderStatus')->name('order.status');
    //     Route::get('/invoice/{orderId}/generate', 'GenerateInvoice')->name('invoice.generate');
    //     Route::get('/invoice/{orderId}', 'ViewInvoice')->name('invoice.view');
    //     Route::get('/invoice/{orderId}/mail', 'MailInvoice')->name('invoice.mail');
    //     Route::get('/print/orders/list', 'PrintOrdersList')->name('print.orders.list');
    //     Route::get('/filter/list', 'FilterOrderList')->name('filter.order.list');
    //     Route::get('/orders/report/pdf', 'OrdersReportPdf')->name('orders.report.pdf');
    //     Route::get('/orders/report/daily/pdf', 'OrdersReportDailyPdf')->name('orders.report.daily.pdf');
    //     Route::get('/orders/report/weekly/pdf', 'OrdersReportWeeklyPdf')->name('orders.report.weekly.pdf');
    //     Route::get('/orders/report/monthly/pdf', 'OrdersReportMonthlyPdf')->name('orders.report.monthly.pdf');
    //     Route::get('/orders/report/yearly/pdf', 'OrdersReportYearlyPdf')->name('orders.report.yearly.pdf');
    // });

    // //Setting
    // Route::controller(SettingController::class)->group(function () {
    //     Route::get('/footer/setting', 'FooterSetting')->name('footer.setting');
    //     Route::get('/footer/add/{id}', 'FooterAdd')->name('footer.add');
    //     Route::post('/footer/store', 'FooterStore')->name('footer.store');
    // });

    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'UserAll')->name('user');
        Route::get('/user/add', 'UserAdd')->name('user.add');
        Route::post('/user/store', 'UserStore')->name('user.store');
        Route::get('/user/edit/{id}', 'UserEdit')->name('user.edit');
        Route::get('/user/edit/user/{id}', 'UserUserEdit')->name('user.edit.user');
        Route::get('/user/delete/{id}', 'UserDelete')->name('user.delete');
    });

    // //Stock
    // Route::controller(StockController::class)->group(function () {
    //     Route::get('/stock/report', 'StockReport')->name('stock.report');
    //     Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf');
    //     Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise');
    //     Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
    //     Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    // });

    //Notification
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification/minimum', 'NotificationMinimum')->name('notification.minimum');
        Route::get('/notification/nostock', 'NotificationNoStock')->name('notification.nostock');
        // Route::get('/notification/minimum/mail', 'NotificationMinimumMail')->name('notification.minimum.mail');

    });
});
Route::prefix('admin')->middleware(['auth', 'isEmployee'])->group(function () {

    //Purchases
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase', 'PurchaseAll')->name('purchase');
        Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
        Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
        Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
        Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
    });

    //Defaults
    Route::controller(DefaultController::class)->group(function () {
        Route::get('/get-brand', 'GetBrand')->name('get-brand');
        Route::get('/get-category', 'GetCategory')->name('get-category');
        Route::get('/get-product', 'GetProduct')->name('get-product');
        Route::get('/get-product-category', 'GetProductCategory')->name('get-product-category');
    });

    //Return/Refund
    Route::controller(ReturnController::class)->group(function (){
        Route::get('/return/request', 'AdminReturnRequest')->name('admin.return.request');
        Route::get('/approve/return/{id}', 'ApproveReturn');
        Route::get('/all/return', 'AdminAllReturn')->name('admin.all.return');
    });

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Route::get('/notification/minimum/mail', [DashboardController::class, 'NotificationMinimumMail']);
    //Charts
    Route::controller(ChartController::class)->group(function () {
        Route::get('/charts', 'ChartsAll')->name('charts');
    });

    //Supplier
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'SupplierAll')->name('supplier');
    });

    //Unit
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit', 'UnitAll')->name('unit');
    });

    //Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'CategoryAll')->name('category');
    });

    //Brands
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'BrandAll')->name('brand');
    });

    //Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'ProductAll')->name('product');
    });

    //Slider
    Route::controller(SliderController::class)->group(function () {
        Route::get('/slider', 'SliderAll')->name('slider');
        Route::get('/slider/add', 'SliderAdd')->name('slider.add');
        Route::post('/slider/store', 'SliderStore')->name('slider.store');
        Route::get('/slider/edit/{id}', 'SliderEdit')->name('slider.edit');
        Route::post('/slider/update', 'SliderUpdate')->name('slider.update');
        Route::get('/slider/delete/{id}', 'SliderDelete')->name('slider.delete');
    });

    //Orders
    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/orders', 'Orders')->name('orders');
        Route::get('/orders/{orderId}', 'OrderShow')->name('orders.view');
        Route::get('/filter', 'FilterOrder')->name('filter.order');
        Route::put('/orders/{orderId}', 'UpdateOrderStatus')->name('order.status');
        Route::get('/invoice/{orderId}/generate', 'GenerateInvoice')->name('invoice.generate');
        Route::get('/invoice/{orderId}', 'ViewInvoice')->name('invoice.view');
        Route::get('/invoice/{orderId}/mail', 'MailInvoice')->name('invoice.mail');
        Route::get('/print/orders/list', 'PrintOrdersList')->name('print.orders.list');
        Route::get('/filter/list', 'FilterOrderList')->name('filter.order.list');
        Route::get('/orders/report/pdf', 'OrdersReportPdf')->name('orders.report.pdf');
        Route::get('/orders/report/daily/pdf', 'OrdersReportDailyPdf')->name('orders.report.daily.pdf');
        Route::get('/orders/report/weekly/pdf', 'OrdersReportWeeklyPdf')->name('orders.report.weekly.pdf');
        Route::get('/orders/report/monthly/pdf', 'OrdersReportMonthlyPdf')->name('orders.report.monthly.pdf');
        Route::get('/orders/report/yearly/pdf', 'OrdersReportYearlyPdf')->name('orders.report.yearly.pdf');
    });

    //Setting
    Route::controller(SettingController::class)->group(function () {
        Route::get('/footer/setting', 'FooterSetting')->name('footer.setting');
        Route::get('/footer/add/{id}', 'FooterAdd')->name('footer.add');
        Route::post('/footer/store', 'FooterStore')->name('footer.store');
    });

    //Stock
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/report', 'StockReport')->name('stock.report');
        Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf');
        Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise');
        Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    });
});

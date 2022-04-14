<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\signupController;
use App\Http\Controllers\userController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerRecordController;
use App\Http\Controllers\TicketRecordController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EntryRecordController;
use App\Http\Controllers\LockersController;
use App\Http\Controllers\LockerRecordController;
use App\Http\Controllers\ExitRecordController;
USE App\Http\Controllers\DashboardController;

Route::get('/',            [DashboardController::class, 'view'])->name('dash.view');

Route::get('/auth/login',  [signupController::class, 'login'])->name('login');
Route::post('/auth/check', [signupController::class, 'check'])->name('check');
Route::get('/auth/logout', [signupController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {

    Route::get('/',                  [userController::class, 'user'])->name('user');
    Route::post('/add',              [userController::class, 'add_user'])->middleware(['can:isAdmin, App\Models\User'])->name('add_user');
    Route::get('/show-user',         [userController::class, 'show_user'])->middleware(['can:isAdmin, App\Models\User'])->name('show_user');
    Route::get('/edit-user/{id}',    [userController::class, 'edit_user'])->middleware(['can:isAdmin, App\Models\User'])->name('edit_user');
    Route::post('/update-user/{id}', [userController::class, 'update_user'])->middleware(['can:isAdmin, App\Models\User'])->name('update_user');
    Route::get('/delete-user/{id}',  [userController::class, 'delete_user'])->middleware(['can:isAdmin, App\Models\User'])->name('delete_user');
});

Route::group(['middleware' => 'auth', 'prefix' => 'QR'], function () {

    Route::get('/',                       [QrController::class,  'QR'])->middleware(['can:isAdmin, App\Models\User'])->name('QR');
    Route::match(['get', 'post'], '/add', [QrController::class,  'add'])->middleware(['can:isAdmin, App\Models\User'])->name('qr.add');
    Route::get('/show',                   [QrController::class,  'show'])->middleware(['can:isAdmin, App\Models\User'])->name('qr.show');
    Route::get('/edit/{id}',              [QrController::class,  'edit'])->middleware(['can:isAdmin, App\Models\User'])->name('qr.edit');
    Route::post('/update/{id}',           [QrController::class,  'update'])->middleware(['can:isAdmin, App\Models\User'])->name('qr.update');
    Route::post('/delete',                [QrController::class,  'delete'])->middleware(['can:isAdmin, App\Models\User'])->name('qr.delete');
                        //remmaining tickets
    Route::get('/allotted',               [QrController::class,  'allotted'])->name('qr.find.allotted');
    Route::post('/allotted',              [CheckoutController::class, 'checkOut'])->name('qr.checkout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'session'], function () {

    Route::get('/',                  [SessionController::class, 'session'])->name('session');
    Route::post('/add',              [SessionController::class, 'add'])->name('session.add');
    Route::get('/show',              [SessionController::class, 'show'])->name('session.show');
    Route::get('/edit/{id}',         [SessionController::class, 'edit'])->name('session.edit');
    Route::post('/update/{id}',      [SessionController::class, 'update'])->name('session.update');
    Route::post('/delete',           [SessionController::class, 'delete'])->name('session.delete');
                    //Get session remaining tickets
    Route::get('/remaining/tickets', [SessionController::class, 'remainingTickets'])->name('session.tickets');
});

Route::group(['middleware' => 'auth', 'prefix' => 'customers'], function () {

    Route::get('/',               [CustomerController::class, 'ticket'])->middleware(['can:isAdmin, App\Models\User'])->name('customer.ticket');
    Route::get('/add',            [CustomerController::class, 'add'])->middleware(['can:isAdmin, App\Models\User'])->name('customer.add');
    Route::get('/find',           [CustomerController::class, 'find'])->name('customer.find');
    Route::post('/add-customer',  [CustomerController::class, 'addNewCustomer'])->name('customer.add.new');
    Route::post('/update',        [CustomerController::class, 'update'])->middleware(['can:isAdmin, App\Models\User'])->name('customer.update');
    Route::post('/update-ticket', [CustomerController::class, 'update_ticket'])->middleware(['can:isAdmin, App\Models\User'])->name('customer.update_ticket');
    Route::post('/update-status', [CustomerController::class, 'update_status'])->middleware(['can:isAdmin, App\Models\User'])->name('customer.update_status');
});

Route::group(['middleware' => 'auth', 'prefix' => 'ticket'], function () {

    Route::get('/',               [TicketController::class, 'index'])->name('ticket.add');
    Route::post('/',              [TicketController::class, 'store'])->name('ticket.store');
});

Route::group(['middleware' => 'auth', 'prefix' => 'checkout'], function () {

    Route::get('/',                  [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/entries-counter',  [CheckoutController::class, 'entries_counter'])->name('exit.entries_counter');
    Route::post('/exit-counter',     [CheckoutController::class, 'exit_counter'])->name('exit.exit_counter');
});

Route::group(['middleware' => 'auth', 'prefix' => 'exit_records'], function () {

    Route::get('/',                [ExitRecordController::class, 'index'])->name('exit_records.index');
    Route::get('/orderby_date',    [ExitRecordController::class, 'orderby_date'])->name('exit_records.orderby.date');
    Route::get('/orderby_session', [ExitRecordController::class, 'orderby_session'])->name('exit_records.orderby.session');
    Route::get('/exit-report',     [ExitRecordController::class, 'exit_pdf'])->name('exit_record.report');

});

Route::group(['middleware' => 'auth', 'prefix' => 'inventory'], function () {
                                    //Products
    Route::get('/products',             [ProductController::class, 'products'])->name('products');
    Route::post('/add-product',         [ProductController::class, 'add_product'])->name('add_product');
    Route::get('/show-products',        [ProductController::class, 'show_products'])->name('show_products');
    Route::get('/edit-product/{id}',    [ProductController::class, 'edit_products'])->name('edit_products');
    Route::post('/update-product/{id}', [ProductController::class, 'update_products'])->name('update_products');
    Route::post('/delete-product',      [ProductController::class, 'delete_products'])->name('delete_products');
                                    //Purchase
    Route::get('/purchase',              [PurchaseController::class, 'purchase'])->name('purchase');
    Route::post('/add-purchase',         [PurchaseController::class, 'add_purchase'])->name('add_purchase');
    Route::get('/show-purchase',         [PurchaseController::class, 'show_purchase'])->name('show_purchase');
    Route::get('/edit-purchase/{id}',    [PurchaseController::class, 'edit_purchase'])->name('edit_purchase');
    Route::post('/update-purchase/{id}', [PurchaseController::class, 'update_purchase'])->name('update_purchase');
    Route::post('/delete-purchase',      [PurchaseController::class, 'delete_purchase'])->name('delete_purchase');
                                    //Stock
    Route::get('/stock', [StockController::class, 'stock'])->name('stock');
                                    //Vendor
    Route::get('/vendor',              [VendorController::class, 'vendor'])->name('vendor');
    Route::post('/add-vendor',         [VendorController::class, 'add_vendor'])->name('add_vendor');
    Route::get('/show-vendor',         [VendorController::class, 'show_vendor'])->name('show_vendor');
    Route::get('/edit-vendor/{id}',    [VendorController::class, 'edit_vendor'])->name('edit_vendor');
    Route::post('/update-vendor/{id}', [VendorController::class, 'update_vendor'])->name('update_vendor');
    Route::post('/delete-vendor',      [VendorController::class, 'delete_vendor'])->name('delete_vendor');
});

Route::group(['middleware' => 'auth', 'prefix' => 'customer_records'], function () {

    Route::get('/',              [CustomerRecordController::class, 'index'])->name('customer.record');
    Route::post('/view',         [CustomerRecordController::class, 'view'])->name('record.view');
    Route::get('/edit/{id}',     [CustomerRecordController::class, 'edit'])->name('record.edit');
    Route::post('/update/{id}',  [CustomerRecordController::class, 'update'])->name('record.update');
    Route::post('/delete',       [CustomerRecordController::class, 'delete'])->name('record.delete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'ticket_records'], function () {

    Route::get('/',                 [TicketRecordController::class, 'index'])->name('ticket.record');
    Route::post('/view',            [TicketRecordController::class, 'view'])->name('ticket.view');
    Route::get('/orderby_date',     [TicketRecordController::class, 'orderby_date'])->name('ticket_records.orderby.date');
    Route::get('/orderby_session',  [TicketRecordController::class, 'orderby_session'])->name('ticket_records.orderby.session');
    Route::get('/ticket-report',    [TicketRecordController::class, 'ticket_pdf'])->name('ticket_record.report');

});

Route::group(['middleware' => 'auth', 'prefix' => 'entry'], function () {

    Route::get('/',     [EntryController::class, 'index'])->name('entry.index');
    Route::get('/show', [EntryController::class, 'show'])->name('entry.show');
    Route::post('/add', [EntryController::class, 'add'])->name('entry.add');
});

Route::group(['middleware' => 'auth', 'prefix' => 'entry_records'], function () {

    Route::get('/',                    [EntryRecordController::class, 'index'])->name('entry_record.index');
    Route::get('/edit/{id}',           [EntryRecordController::class, 'edit'])->name('entry_record.edit');
    Route::post('/update/{id}',        [EntryRecordController::class, 'update'])->name('entry_record.update');
    Route::post('/delete',             [EntryRecordController::class, 'delete'])->name('entry_record.delete');
    Route::get('/orderby_date',        [EntryRecordController::class, 'orderby_date'])->name('entry_records.orderby.date');
    Route::get('/orderby_session',     [EntryRecordController::class, 'orderby_session'])->name('entry_records.orderby.session');
    Route::get('/entry_report',        [EntryRecordController::class, 'entry_pdf'])->name('entry_record.report');

});

Route::group(['middleware' => 'auth', 'prefix' => 'booking'], function () {

    Route::get('/',                 [BookingController::class, 'index'])->name('booking.index');
    Route::post('/add',             [BookingController::class, 'create'])->name('booking.add.new');
    Route::get('/find',             [BookingController::class, 'find'])->name('booking.find');
    Route::get('/remaining',        [BookingController::class, 'remainingTickets'])->name('booking.remaining');
    Route::get('/allotted',         [BookingController::class, 'allotted'])->name('booking.allotted');
    Route::post('/store',           [BookingController::class, 'store'])->name('booking.store');
    Route::get('/view',             [BookingController::class, 'view'])->name('booking.view');
    Route::post('/view',            [BookingController::class, 'assign'])->name('booking.assign');
    Route::post('/delete',          [BookingController::class, 'delete'])->name('booking.delete');
    Route::post('/no_of_tickets',   [BookingController::class, 'no_of_tickets'])->name('booking.no_of_tickets');
    Route::post('/multiple-assign', [BookingController::class, 'multiple_assign'])->name('booking.multiple_assign');
    Route::post('/del_all_sessions',[BookingController::class, 'del_all_sessions'])->name('booking.delete_all_sessions');
    Route::get('/orderby_date',     [BookingController::class, 'orderby_date'])->name('booking.orderby.date');
    Route::get('/orderby_session',  [BookingController::class, 'orderby_session'])->name('booking.orderby.session');
    Route::get('/booking_report',   [BookingController::class, 'booking_pdf'])->name('booking_record.report');

});

Route::group(['middleware' => 'auth', 'prefix' => 'lockers'], function () {

    Route::get('/',                    [LockersController::class, 'index'])->name('lockers.index');
    Route::get('/add',                 [LockersController::class, 'add_view'])->name('lockers.add.view');
    Route::post('/add-locker',         [LockersController::class, 'add_locker'])->name('lockers.add');
    Route::get('/edit-locker/{id}',    [LockersController::class, 'edit_view'])->name('lockers.edit.view');
    Route::post('/update-locker/{id}', [LockersController::class, 'update'])->name('lockers.update');
    Route::post('/delete',             [LockersController::class, 'delete'])->name('lockers.delete');
    Route::get('/assign',              [LockersController::class, 'assign_view'])->name('lockers.assign.view');
    Route::post('/assign-lockers',     [LockersController::class, 'assign_lockers'])->name('lockers.assign');
    Route::get('/free-lockers',        [LockersController::class, 'free_lockers_view'])->name('lockers_free.view');
    Route::get('/free',                [LockersController::class, 'free'])->name('lockers.free');
});

Route::group(['middleware' => 'auth', 'prefix' => 'locker_records'], function () {

    Route::get('/',                    [LockerRecordController::class, 'index'])->name('locker_records.index');
    Route::get('/orderby_date',        [LockerRecordController::class, 'orderby_date'])->name('locker_records.orderby.date');
    Route::get('/orderby_session',     [LockerRecordController::class, 'orderby_session'])->name('locker_records.orderby.session');
    Route::get('/locker_report',       [LockerRecordController::class, 'locker_pdf'])->name('locker_record.report');

});


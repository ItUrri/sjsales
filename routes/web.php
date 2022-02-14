<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

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

Route::get('/', function () {return view('home');});
Route::get('auth', function () {return view('auth.index');})->name('auth');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');

/*
 *
 *  GET         /photos                 index       photos.index
 *  GET         /photos/create          create      photos.create
 *  POST        /photos                 store       photos.store
 *  GET         /photos/{photo}         show        photos.show
 *  GET         /photos/{photo}/edit    edit        photos.edit
 *  PUT/PATCH   /photos/{photo}         update      photos.update
 *  DELETE      /photos/{photo}         destroy     photos.destroy
 */
Route::resources([
    'areas'       => Controllers\AreaController::class,
    'areas.orders' => Controllers\Area\OrderController::class,
    'areas.movements' => Controllers\Area\MovementController::class,
    'departments' => Controllers\DepartmentController::class,
    'orders'      => Controllers\OrderController::class,
    'orders.products' => Controllers\Order\ProductController::class,
    'suppliers'   => Controllers\SupplierController::class,
    'suppliers.contacts' => Controllers\Supplier\ContactController::class,
    'suppliers.invoiceds' => Controllers\Supplier\InvoicedController::class,
    'suppliers.incidences' => Controllers\Supplier\IncidenceController::class,
    'suppliers.orders' => Controllers\Supplier\OrderController::class,
    'suppliers.movements' => Controllers\Supplier\MovementController::class,
    'movements'      => Controllers\MovementController::class,
], [
    'middleware' => 'auth'
]);

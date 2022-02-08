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

Route::get('/', function () {
    return view('welcome');
});

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
    'departments' => Controllers\DepartmentController::class,
    'orders'      => Controllers\OrderController::class,
    'orders.products' => Controllers\Order\ProductController::class,
    'suppliers'   => Controllers\SupplierController::class,
    'suppliers.contacts' => Controllers\Supplier\ContactController::class,
    'areas.orders' => Controllers\Areas\OrderController::class,
    'movements'      => Controllers\MovementController::class,
]);


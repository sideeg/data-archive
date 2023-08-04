<?php

use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
 


Route::view('/', 'home')->middleware('auth');
Auth::routes();

Route::redirect('/', '/login/employee');
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm');
Route::get('/register/employee', 'Auth\RegisterController@showEmployeeRegisterForm');


Route::post('/login/employee', 'Auth\LoginController@employeeLogin');
Route::post('/register/employee', 'Auth\RegisterController@createEmployee');
 

 
route::middleware('auth:employee')->group(function(){

  Route::get('/main', "HomeController@main");
  
  Route::get('deliverytimes/filter', 'DeliveryTimeController@filter')->name('deliverytimes.filter')->middleware(['role:delivery supervisor|admin']);
  Route::resource('employees', 'EmployeeController')->middleware(['role:admin']);
  Route::resource('orders', 'OrderController')->middleware(['role:call center|admin']);
  Route::resource('medications', 'MedicationController')->middleware(['role:medicine supervisor|admin']);
  Route::resource('deliverytimes', 'DeliveryTimeController')->middleware(['role:admin']);
 
  //For DataTables Only
  Route::get('/orders/index/data','OrderController@index_data')->middleware('auth:employee');
  Route::get('/orders/pdf/{id}','OrderController@export_pdf');
  Route::put('/orders/proccess/{id}', 'OrderController@proccess')->name('orders.proccess');
  Route::put('/orders/cancel/{id}', 'OrderController@cancel')->name('orders.cancel');
  Route::put('/orders/comment/{id}', 'OrderController@comment')->name('orders.comment');
});


<?php

use App\Http\Controllers\SuperadminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// superadmin
Route::get('superadmin/home', [App\Http\Controllers\SuperadminController::class, 'index'])->name('admin.home')->middleware('superadmin');
Route::get('superadmin/profile', [SuperadminController::class, 'profile'])->name('admin.profile')->middleware('superadmin');
Route::get('superadmin/employees', [SuperadminController::class, 'employees'])->name('admin.employees')->middleware('superadmin');
Route::get('superadmin/adduser', [SuperadminController::class, 'adduser'])->name('admin.adduser')->middleware('superadmin');
Route::post('superadmin/addemp', [SuperadminController::class, 'addemp'])->name('admin.addemp')->middleware('superadmin');
Route::get('superadmin/calender', [SuperadminController::class, 'calender'])->name('admin.calender')->middleware('superadmin');
Route::get('superadmin/inbox', [SuperadminController::class, 'inbox'])->name('admin.inbox')->middleware('superadmin');
Route::get('superadmin/read', [SuperadminController::class, 'read'])->name('admin.read')->middleware('superadmin');
Route::get('superadmin/compose', [SuperadminController::class, 'compose'])->name('admin.compose')->middleware('superadmin');
Route::get('superadmin/apex', [SuperadminController::class, 'apex'])->name('admin.apex')->middleware('superadmin');
Route::get('superadmin/addlead', [SuperadminController::class, 'addlead'])->name('admin.addlead')->middleware('superadmin');


// salesmanager
Route::get('salesmanager/home', [App\Http\Controllers\SalesmanagerController::class, 'index'])->name('salesmanager.home')->middleware('salesexecutive');


// salesexecutive
Route::get('salesexecutive/home', [App\Http\Controllers\SalesexecutiveController::class, 'index'])->name('salesexecutive.home')->middleware('salesmanager');


// telecaller
Route::get('telecaller/home', [App\Http\Controllers\TelecallerController::class, 'index'])->name('telecaller.home')->middleware('telecaller');


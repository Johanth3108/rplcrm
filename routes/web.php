<?php

use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SalesmanagerController;
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
Route::get('salesmanager/home', [SalesmanagerController::class, 'index'])->name('salesmanager.home')->middleware('salesmanager');
Route::get('salesmanager/calender', [SalesmanagerController::class, 'calender'])->name('salesmanager.calender')->middleware('salesmanager');
Route::get('salesmanager/message', [SalesmanagerController::class, 'message'])->name('salesmanager.message')->middleware('salesmanager');
Route::post('salesmanager/message/send', [SalesmanagerController::class, 'send'])->name('salesmanager.message.send')->middleware('salesmanager');
Route::get('salesmanager/whatsapp', [SalesmanagerController::class, 'whatsapp'])->name('salesmanager.whatsapp')->middleware('salesmanager');
Route::post('salesmanager/whatsapp/send', [SalesmanagerController::class, 'whatsappsend'])->name('salesmanager.whatsapp.send')->middleware('salesmanager');
Route::get('salesmanager/leads', [SalesmanagerController::class, 'leads'])->name('salesmanager.leads')->middleware('salesmanager');
Route::get('salesmanager/addleads', [SalesmanagerController::class, 'addleads'])->name('salesmanager.addleads')->middleware('salesmanager');
Route::post('salesmanager/addleads/save', [SalesmanagerController::class, 'addleadsave'])->name('salesmanager.addleads.save')->middleware('salesmanager');
Route::get('salesmanager/apex', [SalesmanagerController::class, 'apex'])->name('salesmanager.apex')->middleware('salesmanager');
Route::get('salesmanager/employer', [SalesmanagerController::class, 'employer'])->name('salesmanager.employer')->middleware('salesmanager');




// salesexecutive
Route::get('salesexecutive/home', [App\Http\Controllers\SalesexecutiveController::class, 'index'])->name('salesexecutive.home')->middleware('salesexecutive');
// Route::get('salesexecutive/home', [App\Http\Controllers\SalesexecutiveController::class, 'index'])->name('salesexecutive.home')->middleware('salesexecutive');


// telecaller
Route::get('telecaller/home', [App\Http\Controllers\TelecallerController::class, 'index'])->name('telecaller.home')->middleware('telecaller');


<?php

use App\Http\Controllers\SalesexecutiveController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SalesmanagerController;
use App\Http\Controllers\TelecallerController;
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

// reports
Route::get('report/download', [SuperadminController::class, 'repdown'])->name('admin.report.download');
Route::get('leads/download', [SuperadminController::class, 'leadsdown'])->name('admin.leads.download');
Route::get('properties/download', [SuperadminController::class, 'propertydown'])->name('admin.property.download');



// superadmin
Route::get('superadmin/home', [App\Http\Controllers\SuperadminController::class, 'index'])->name('admin.home')->middleware('superadmin');
Route::get('superadmin/profile', [SuperadminController::class, 'profile'])->name('admin.profile')->middleware('superadmin');
Route::post('superadmin/profile/update/{id}', [SuperadminController::class, 'profileupdate'])->name('admin.update')->middleware('superadmin');
Route::get('superadmin/employees', [SuperadminController::class, 'employees'])->name('admin.employees')->middleware('superadmin');
Route::get('superadmin/employees/edit/{id}', [SuperadminController::class, 'employeeedit'])->name('admin.employeeedit')->middleware('superadmin');
Route::post('superadmin/employees/save/{id}', [SuperadminController::class, 'save'])->name('admin.save')->middleware('superadmin');
Route::get('superadmin/adduser', [SuperadminController::class, 'adduser'])->name('admin.adduser')->middleware('superadmin');
Route::post('superadmin/addemp', [SuperadminController::class, 'addemp'])->name('admin.addemp')->middleware('superadmin');
Route::get('superadmin/calender', [SuperadminController::class, 'calender'])->name('admin.calender')->middleware('superadmin');
// Route::get('superadmin/read', [SuperadminController::class, 'read'])->name('admin.read')->middleware('superadmin');
// Route::get('superadmin/compose', [SuperadminController::class, 'compose'])->name('admin.compose')->middleware('superadmin');
Route::get('superadmin/apex', [SuperadminController::class, 'apex'])->name('admin.apex')->middleware('superadmin');
Route::get('superadmin/addlead', [SuperadminController::class, 'addlead'])->name('admin.addlead')->middleware('superadmin');
Route::post('superadmin/savelead', [SuperadminController::class, 'savelead'])->name('admin.savelead')->middleware('superadmin');
Route::get('superadmin/managelead/{id}', [SuperadminController::class, 'managelead'])->name('admin.managelead')->middleware('superadmin');
Route::post('superadmin/updatelead/{id}', [SuperadminController::class, 'updatelead'])->name('admin.updatelead')->middleware('superadmin');
Route::get('superadmin/leads', [SuperadminController::class, 'leads'])->name('admin.leads')->middleware('superadmin');
Route::get('superadmin/properties', [SuperadminController::class, 'properties'])->name('admin.properties')->middleware('superadmin');
Route::get('superadmin/addprop', [SuperadminController::class, 'addprop'])->name('admin.addprop')->middleware('superadmin');
Route::post('superadmin/addprop/save', [SuperadminController::class, 'saveprop'])->name('admin.saveprop')->middleware('superadmin');
Route::get('superadmin/addprop/manage/{id}', [SuperadminController::class, 'manageprop'])->name('admin.manageprop')->middleware('superadmin');
Route::post('superadmin/addprop/update/{id}', [SuperadminController::class, 'updateprop'])->name('admin.updateprop')->middleware('superadmin');
Route::get('superadmin/prop-type', [SuperadminController::class, 'proptype'])->name('admin.proptype')->middleware('superadmin');
Route::post('superadmin/prop-type/add', [SuperadminController::class, 'proptypeadd'])->name('admin.proptype.add')->middleware('superadmin');
Route::get('superadmin/message', [SuperadminController::class, 'message'])->name('admin.message')->middleware('superadmin');
Route::get('superadmin/message/reply/{id}', [SuperadminController::class, 'reply'])->name('admin.reply')->middleware('superadmin');
Route::post('superadmin/message/send', [SuperadminController::class, 'messagesend'])->name('admin.message.send')->middleware('superadmin');
Route::get('superadmin/inbox', [SuperadminController::class, 'inbox'])->name('admin.inbox')->middleware('superadmin');
Route::get('superadmin/manpage', [SuperadminController::class, 'manpage'])->name('admin.manpage')->middleware('superadmin');
Route::post('superadmin/manpage/save', [SuperadminController::class, 'manpagesave'])->name('admin.manpage.save')->middleware('superadmin');
Route::get('superadmin/exepage', [SuperadminController::class, 'exepage'])->name('admin.exepage')->middleware('superadmin');
Route::post('superadmin/exepage/save', [SuperadminController::class, 'exepagesave'])->name('admin.exepage.save')->middleware('superadmin');
Route::get('superadmin/telepage', [SuperadminController::class, 'telepage'])->name('admin.telepage')->middleware('superadmin');
Route::post('superadmin/telepage/save', [SuperadminController::class, 'telepagesave'])->name('admin.telepage.save')->middleware('superadmin');





// salesmanager
Route::get('salesmanager/home', [SalesmanagerController::class, 'index'])->name('salesmanager.home')->middleware('salesmanager');
Route::get('salesmanager/profile', [SalesmanagerController::class, 'profile'])->name('salesmanager.profile')->middleware('salesmanager');
Route::get('salesmanager/assigned', [SalesmanagerController::class, 'assigned'])->name('salesmanager.assigned')->middleware('salesmanager');
Route::get('salesmanager/calender', [SalesmanagerController::class, 'calender'])->name('salesmanager.calender')->middleware('salesmanager');
Route::get('salesmanager/message', [SalesmanagerController::class, 'message'])->name('salesmanager.message')->middleware('salesmanager');
Route::post('salesmanager/message/send', [SalesmanagerController::class, 'send'])->name('salesmanager.message.send')->middleware('salesmanager');
Route::get('salesmanager/whatsapp', [SalesmanagerController::class, 'whatsapp'])->name('salesmanager.whatsapp')->middleware('salesmanager');
Route::post('salesmanager/whatsapp/send', [SalesmanagerController::class, 'whatsappsend'])->name('salesmanager.whatsapp.send')->middleware('salesmanager');
Route::get('salesmanager/leads', [SalesmanagerController::class, 'leads'])->name('salesmanager.leads')->middleware('salesmanager');
Route::get('salesmanager/leads/view/{id}', [SalesmanagerController::class, 'leadsview'])->name('salesmanager.leads.view')->middleware('salesmanager');
Route::post('salesmanager/leads/view/save/{id}', [SalesmanagerController::class, 'leadssave'])->name('salesmanager.leads.save')->middleware('salesmanager');
Route::get('salesmanager/addleads', [SalesmanagerController::class, 'addleads'])->name('salesmanager.addleads')->middleware('salesmanager');
Route::post('salesmanager/addleads/save', [SalesmanagerController::class, 'addleadsave'])->name('salesmanager.addleads.save')->middleware('salesmanager');
Route::get('salesmanager/apex', [SalesmanagerController::class, 'apex'])->name('salesmanager.apex')->middleware('salesmanager');
Route::get('salesmanager/employer', [SalesmanagerController::class, 'employer'])->name('salesmanager.employer')->middleware('salesmanager');
Route::get('salesmanager/pmessage', [SalesmanagerController::class, 'pmessage'])->name('salesmanager.pmessage')->middleware('salesmanager');
Route::get('salesmanager/pmessage/reply/{id}', [SalesmanagerController::class, 'pmessagereply'])->name('salesmanager.pmessage.reply')->middleware('salesmanager');
Route::post('salesmanager/pmessagesend', [SalesmanagerController::class, 'pmessagesend'])->name('salesmanager.pmessagesend')->middleware('salesmanager');
Route::get('salesmanager/inbox', [SalesmanagerController::class, 'inbox'])->name('salesmanager.inbox')->middleware('salesmanager');
Route::get('salesmanager/properties', [SalesmanagerController::class, 'properties'])->name('salesmanager.properties')->middleware('salesmanager');





// salesexecutive
Route::get('salesexecutive/home', [App\Http\Controllers\SalesexecutiveController::class, 'index'])->name('salesexecutive.home')->middleware('salesexecutive');
Route::get('salesexecutive/profile', [SalesexecutiveController::class, 'profile'])->name('salesexecutive.profile')->middleware('salesexecutive');
Route::get('salesexecutive/assigned', [SalesexecutiveController::class, 'assigned'])->name('salesexecutive.assigned')->middleware('salesexecutive');
Route::get('salesexecutive/message', [SalesexecutiveController::class, 'message'])->name('salesexecutive.message')->middleware('salesexecutive');
Route::get('salesexecutive/whatsapp', [SalesexecutiveController::class, 'whatsapp'])->name('salesexecutive.whatsapp')->middleware('salesexecutive');
Route::get('salesexecutive/calender', [SalesexecutiveController::class, 'calender'])->name('salesexecutive.calender')->middleware('salesexecutive');
Route::get('salesexecutive/leads', [SalesexecutiveController::class, 'leads'])->name('salesexecutive.leads')->middleware('salesexecutive');
Route::get('salesexecutive/leads/view/{id}', [SalesexecutiveController::class, 'leadsview'])->name('salesexecutive.leads.view')->middleware('salesexecutive');
Route::post('salesexecutive/leads/view/save/{id}', [SalesexecutiveController::class, 'leadssave'])->name('salesexecutive.leads.save')->middleware('salesexecutive');
Route::get('salesexecutive/assign', [SalesexecutiveController::class, 'assign'])->name('salesexecutive.assign')->middleware('salesexecutive');
Route::post('salesexecutive/assign/send', [SalesexecutiveController::class, 'assignsend'])->name('salesexecutive.assignsend')->middleware('salesexecutive');
Route::get('salesexecutive/pmessage', [SalesexecutiveController::class, 'pmessage'])->name('salesexecutive.pmessage')->middleware('salesexecutive');
Route::get('salesexecutive/pmessage/reply/{id}', [SalesexecutiveController::class, 'pmessagereply'])->name('salesexecutive.pmessage.reply')->middleware('salesexecutive');
Route::post('salesexecutive/pmessage/send', [SalesexecutiveController::class, 'pmessagesend'])->name('salesexecutive.pmessage.send')->middleware('salesexecutive');
Route::get('salesexecutive/inbox', [SalesexecutiveController::class, 'inbox'])->name('salesexecutive.inbox')->middleware('salesexecutive');


// telecaller
Route::get('telecaller/home', [App\Http\Controllers\TelecallerController::class, 'index'])->name('telecaller.home')->middleware('telecaller');
Route::get('telecaller/profile', [TelecallerController::class, 'profile'])->name('telecaller.profile')->middleware('telecaller');
Route::get('telecaller/calender', [TelecallerController::class, 'calender'])->name('telecaller.calender')->middleware('telecaller');
Route::get('telecaller/assigned', [TelecallerController::class, 'assigned'])->name('telecaller.assigned')->middleware('telecaller');
Route::get('telecaller/message', [TelecallerController::class, 'message'])->name('telecaller.message')->middleware('telecaller');
Route::get('telecaller/message/reply/{id}', [TelecallerController::class, 'reply'])->name('telecaller.message.reply')->middleware('telecaller');
Route::post('telecaller/message/send', [TelecallerController::class, 'messagesend'])->name('telecaller.message.send')->middleware('telecaller');
Route::get('telecaller/inbox', [TelecallerController::class, 'inbox'])->name('telecaller.inbox')->middleware('telecaller');



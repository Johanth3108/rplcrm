<?php

use App\Http\Controllers\AreamanagerController;
use App\Http\Controllers\SalesexecutiveController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SalesmanagerController;
use App\Http\Controllers\TelecallerController;
use App\Models\areamanager;
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
Route::get('superadmin/managelead/{id}', [SuperadminController::class, 'managelead'])->name('admin.managelead')->middleware('superadmin', 'salesmanager', 'salesexecutive');
Route::post('superadmin/updatelead/{id}', [SuperadminController::class, 'updatelead'])->name('admin.updatelead')->middleware('superadmin');
Route::get('superadmin/deletelead/{id}', [SuperadminController::class, 'deletelead'])->name('admin.deletelead')->middleware('superadmin');
Route::get('superadmin/leads', [SuperadminController::class, 'leads'])->name('admin.leads')->middleware('superadmin');
Route::get('superadmin/properties', [SuperadminController::class, 'properties'])->name('admin.properties')->middleware('superadmin');
Route::get('superadmin/addprop', [SuperadminController::class, 'addprop'])->name('admin.addprop')->middleware('superadmin');
Route::post('superadmin/addprop/save', [SuperadminController::class, 'saveprop'])->name('admin.saveprop')->middleware('superadmin');
Route::get('superadmin/addprop/manage/{id}', [SuperadminController::class, 'manageprop'])->name('admin.manageprop')->middleware('superadmin');
Route::get('superadmin/addprop/delete/{id}', [SuperadminController::class, 'deleteprop'])->name('admin.deleteprop')->middleware('superadmin');
Route::post('superadmin/addprop/update/{id}', [SuperadminController::class, 'updateprop'])->name('admin.updateprop')->middleware('superadmin');
Route::get('superadmin/prop-type', [SuperadminController::class, 'proptype'])->name('admin.proptype')->middleware('superadmin');
Route::post('superadmin/prop-type/add', [SuperadminController::class, 'proptypeadd'])->name('admin.proptype.add')->middleware('superadmin');
Route::get('superadmin/prop-type/delete/{id}', [SuperadminController::class, 'proptypedel'])->name('admin.proptype.delete')->middleware('superadmin');
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
Route::get('superadmin/feedback/{id}', [SuperadminController::class, 'feedback'])->name('admin.feedback');
Route::post('superadmin/feedback/send', [SuperadminController::class, 'feedbacksend'])->name('admin.feedback.send');
Route::get('superadmin/clients', [SuperadminController::class, 'clients'])->name('admin.clients');


// areamanager
Route::get('areamanager/home', [App\Http\Controllers\AreamanagerController::class, 'index'])->name('areamanager.home')->middleware('areamanager');
Route::get('areamanager/profile', [AreamanagerController::class, 'profile'])->name('areamanager.profile')->middleware('areamanager');
Route::post('areamanager/profile/update/{id}', [AreamanagerController::class, 'profileupdate'])->name('areamanager.update')->middleware('areamanager');
Route::get('areamanager/employees', [AreamanagerController::class, 'employees'])->name('areamanager.employees')->middleware('areamanager');
Route::get('areamanager/employees/edit/{id}', [AreamanagerController::class, 'employeeedit'])->name('areamanager.employeeedit')->middleware('areamanager');
Route::post('areamanager/employees/save/{id}', [AreamanagerController::class, 'save'])->name('areamanager.save')->middleware('areamanager');
Route::get('areamanager/adduser', [AreamanagerController::class, 'adduser'])->name('areamanager.adduser')->middleware('areamanager');
Route::post('areamanager/addemp', [AreamanagerController::class, 'addemp'])->name('areamanager.addemp')->middleware('areamanager');
Route::get('areamanager/calender', [AreamanagerController::class, 'calender'])->name('areamanager.calender')->middleware('areamanager');
Route::get('areamanager/apex', [AreamanagerController::class, 'apex'])->name('areamanager.apex')->middleware('areamanager');
Route::get('areamanager/addlead', [AreamanagerController::class, 'addlead'])->name('areamanager.addlead')->middleware('areamanager');
Route::post('areamanager/savelead', [AreamanagerController::class, 'savelead'])->name('areamanager.savelead')->middleware('areamanager');
Route::get('areamanager/managelead/{id}', [AreamanagerController::class, 'managelead'])->name('areamanager.managelead')->middleware('areamanager');
Route::post('areamanager/updatelead/{id}', [AreamanagerController::class, 'updatelead'])->name('areamanager.updatelead')->middleware('areamanager');
Route::get('areamanager/deletelead/{id}', [AreamanagerController::class, 'deletelead'])->name('areamanager.deletelead')->middleware('areamanager');
Route::get('areamanager/leads', [AreamanagerController::class, 'leads'])->name('areamanager.leads')->middleware('areamanager');
Route::get('areamanager/properties', [AreamanagerController::class, 'properties'])->name('areamanager.properties')->middleware('areamanager');
Route::get('areamanager/addprop', [AreamanagerController::class, 'addprop'])->name('areamanager.addprop')->middleware('areamanager');
Route::post('areamanager/addprop/save', [AreamanagerController::class, 'saveprop'])->name('areamanager.saveprop')->middleware('areamanager');
Route::get('areamanager/addprop/manage/{id}', [AreamanagerController::class, 'manageprop'])->name('areamanager.manageprop')->middleware('areamanager');
Route::get('areamanager/addprop/delete/{id}', [AreamanagerController::class, 'deleteprop'])->name('areamanager.deleteprop')->middleware('areamanager');
Route::post('areamanager/addprop/update/{id}', [AreamanagerController::class, 'updateprop'])->name('areamanager.updateprop')->middleware('areamanager');
Route::get('areamanager/prop-type', [AreamanagerController::class, 'proptype'])->name('areamanager.proptype')->middleware('areamanager');
Route::post('areamanager/prop-type/add', [AreamanagerController::class, 'proptypeadd'])->name('areamanager.proptype.add')->middleware('areamanager');
Route::get('areamanager/prop-type/delete/{id}', [AreamanagerController::class, 'proptypedel'])->name('areamanager.proptype.delete')->middleware('areamanager');
Route::get('areamanager/message', [AreamanagerController::class, 'message'])->name('areamanager.message')->middleware('areamanager');
Route::get('areamanager/message/reply/{id}', [AreamanagerController::class, 'reply'])->name('areamanager.reply')->middleware('areamanager');
Route::post('areamanager/message/send', [AreamanagerController::class, 'messagesend'])->name('areamanager.message.send')->middleware('areamanager');
Route::get('areamanager/inbox', [AreamanagerController::class, 'inbox'])->name('areamanager.inbox')->middleware('areamanager');
Route::get('areamanager/manpage', [AreamanagerController::class, 'manpage'])->name('areamanager.manpage')->middleware('areamanager');
Route::post('areamanager/manpage/save', [AreamanagerController::class, 'manpagesave'])->name('areamanager.manpage.save')->middleware('areamanager');
Route::get('areamanager/exepage', [AreamanagerController::class, 'exepage'])->name('areamanager.exepage')->middleware('areamanager');
Route::post('areamanager/exepage/save', [AreamanagerController::class, 'exepagesave'])->name('areamanager.exepage.save')->middleware('areamanager');
Route::get('areamanager/telepage', [AreamanagerController::class, 'telepage'])->name('areamanager.telepage')->middleware('areamanager');
Route::post('areamanager/telepage/save', [AreamanagerController::class, 'telepagesave'])->name('areamanager.telepage.save')->middleware('areamanager');
Route::get('areamanager/feedback/{id}', [AreamanagerController::class, 'feedback'])->name('areamanager.feedback');
Route::post('areamanager/feedback/send', [AreamanagerController::class, 'feedbacksend'])->name('areamanager.feedback.send');
Route::get('areamanager/clients', [AreamanagerController::class, 'clients'])->name('areamanager.clients');


// salesmanager
Route::get('salesmanager/home', [SalesmanagerController::class, 'index'])->name('salesmanager.home')->middleware('salesmanager');
Route::get('salesmanager/profile', [SalesmanagerController::class, 'profile'])->name('salesmanager.profile')->middleware('salesmanager');
Route::get('salesmanager/assigned', [SalesmanagerController::class, 'assigned'])->name('salesmanager.assigned')->middleware('salesmanager');
Route::get('salesmanager/feedback/{id}', [SalesmanagerController::class, 'feedback'])->name('salesmanager.feedback')->middleware('salesmanager');
Route::post('salesmanager/feedback/send', [SalesmanagerController::class, 'feedbacksend'])->name('salesmanager.feedback.send')->middleware('salesmanager');
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
Route::get('salesexecutive/feedback/{id}', [SalesexecutiveController::class, 'feedback'])->name('salesexecutive.feedback')->middleware('salesexecutive');
Route::post('salesexecutive/feedback/send', [SalesexecutiveController::class, 'feedbacksend'])->name('salesexecutive.feedback.send')->middleware('salesexecutive');
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
Route::get('telecaller/feedback/{id}', [TelecallerController::class, 'feedback'])->name('telecaller.feedback')->middleware('telecaller');
Route::post('telecaller/feedback/send', [TelecallerController::class, 'feedbacksend'])->name('telecaller.feedback.send')->middleware('telecaller');



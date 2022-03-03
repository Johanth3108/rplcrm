<?php

use App\Http\Controllers\API;
use App\Http\Controllers\SuperadminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('lead/create', [API::class, 'post_recieve_lead'])->name('api.post');
Route::put('lead/get/create/{api_key}&{email}&{mobile}&{name}&{project}&{City}&{source}', [API::class, 'get_recieve_lead'])->name('api.get');
// Route::put('lead/get/create?{api_key}&{email}&{mobile}&{name}&{project}&{City}&{source}', function ($id) {
//     dd('test');
// });
// ?api_key=33dd2f75aed541849b8072fe953a6c05&email=debasishrighthere%40gmail.com&mobile=9051022115&name=DEBASISH+GHOSH&project=null&City=Kolkata&source=Magicbricks
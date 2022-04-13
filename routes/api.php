<?php

use App\Models\Contact;
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

Route::get('contacts' , function () {
    return Contact::latest()->orderBy('created_at', 'desc')->get();
});

Route::get('contact/{id}', function ($id) {
    return Contact::findOrFail($id);
});

Route::post('contact/store', function (Request $request) {
    return Contact::create($request->all());
});

Route::patch('contact/{id}', function (Request $request, $id) {
    $contact = Contact::findOrFail($id);
    $contact->update($request->all());
    return $contact;
});

Route::delete('contact/{id}', function ($id) {
    return Contact::findOrFail($id)->delete();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

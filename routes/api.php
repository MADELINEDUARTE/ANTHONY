<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\VerificacionDeEmailController;
use App\Http\Controllers\OlvideClaveController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\CardRegisterController;
use App\Http\Controllers\HomeDisplayController;
use App\Http\Controllers\UsersManagement;

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

/*
Route::middleware('token_validate')->group(function(){
    Route::get('home',[HomeController::class,'index']);
});
*/

Route::post('login',[UsersManagement::class,'login']);
Route::post('register',[UsersManagement::class,'register']);
Route::post('logout', [UsersManagement::class, 'logout'])->middleware('auth:sanctum');
Route::post('update_user',[UsersManagement::class,'update_user']);


Route::post('register_user_program',[UsersManagement::class,'register_user_program']);
Route::apiResource('user_management',UsersManagement::class);

Route::get('program_detail',[HomeDisplayController::class,'program_detail']);
Route::apiResource('home_display',HomeDisplayController::class);

Route::post('register_card',[CardRegisterController::class,'register_card']);
Route::apiResource('card_register',CardRegisterController::class);

//Route::post('email/verificacion_notificacion', [VerificacionDeEmailController::class, 'enviaVerificacionEmail'])->middleware('auth:sanctum');
//Route::get('verificar_email/{id}/{hash}', [VerificacionDeEmailController::class, 'verificar'])->name('verificacion.verificar')->middleware('auth:sanctum');
//Route::apiResource('verificaciondeemailcontroller',VerificacionDeEmailController::class);

Route::post('email/verification-notification', [VerificacionDeEmailController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [VerificacionDeEmailController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');


Route::post('olvide_clave', [OlvideClaveController::class, 'olvide_clave']);
Route::post('resetear_clave', [OlvideClaveController::class, 'resetear_clave']);
Route::apiResource('forgotpasswordcontroller',OlvideClaveController::class);

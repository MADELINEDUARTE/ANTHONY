<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\VerificacionDeEmailController;
use App\Http\Controllers\OlvideClaveController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\CardRegisterController;
use App\Http\Controllers\ExercisePlaceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\FrequentlyAskedQuestionController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HomeDisplayController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\UsersManagement;
use App\Http\Controllers\Api\SubscriptionStripeController;
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
Route::post('validate_code',[UsersManagement::class,'validateCode']);
Route::post('resend_code',[UsersManagement::class,'resendCode']);
Route::post('logout', [UsersManagement::class, 'logout'])->middleware('auth:sanctum');
Route::post('update_user',[UsersManagement::class,'update_user']);

Route::post('register_user_subscription',[UsersManagement::class,'register_user_subscription']);

Route::apiResource('user_management',UsersManagement::class);




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

Route::apiResource('frequency',FrequencyController::class);

Route::apiResource('experience',ExperienceController::class);

Route::apiResource('exercise_place',ExercisePlaceController::class);

Route::apiResource('gender',GenderController::class);

Route::apiResource('reason',ReasonController::class);

Route::apiResource('package',PackageController::class);

Route::apiResource('frequentlyaskedquestion',FrequentlyAskedQuestionController::class);

Route::apiResource('blogpost',BlogPostController::class);

Route::get('get_state',[HomeController::class,'getState']);
Route::get('get_country',[HomeController::class,'getCountry']);



Route::middleware(['token_validate'])->prefix('subscription')->group(function () {

    Route::post('create_cliente_stripe',[HomeController::class,'createClienteStripe']);
    Route::post('setup_stripe',[HomeController::class,'setupStripe']);
    Route::post('create_product',[HomeController::class,'createProduct']);
    Route::post('create_subscription',[HomeController::class,'createSubscription']);
    Route::post('cancel_subscription',[HomeController::class,'cancelSubscription']);
    Route::post('reanudar_subscription',[HomeController::class,'reanudarSubscription']);
    Route::post('get_invoices',[HomeController::class,'getInvoices']);

});

Route::middleware(['token_validate'])->group(function () {
    Route::post('update_address',[HomeController::class,'updateAddress']);
    Route::apiResource('home_display', HomeDisplayController::class);
    Route::get('program_detail',[HomeDisplayController::class,'program_detail']);
    Route::post('register_user_program',[HomeController::class,'register_user_program']);
    Route::post('cancel_user_program',[HomeController::class,'cancel_user_program']);
    Route::post('create_log',[HomeController::class,'create_log']);
    Route::get('get_subscription',[HomeController::class,'getSubscription']);


});




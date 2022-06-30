<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseLogController;
use App\Http\Controllers\ExerciseVideoController;
use App\Http\Controllers\FrequentlyAskedQuestionController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\ProgramCategoryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramDayController;
use App\Http\Controllers\ProgramDayRoutineController;
use App\Http\Controllers\RoutineLogController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionProgramController;
use App\Http\Controllers\SubscriptionProgramDayRoutineController;
use App\Http\Controllers\UserCardController;
use App\Http\Livewire\Admin\AdminAddBlogComponent;
use App\Http\Livewire\Admin\AdminAddExerciseVideoComponent;
use App\Http\Livewire\Admin\AdminAddGendersComponent;
use App\Http\Livewire\Admin\AdminEditGendersComponent;
use App\Http\Livewire\Admin\AdminGendersComponent;
use App\Http\Livewire\Admin\AdminAddProgramComponent;
use App\Http\Livewire\Admin\AdminAddProgramDayRoutineComponent;
use App\Http\Livewire\Admin\AdminBlogComponent;
use App\Http\Livewire\Admin\AdminEditProgramComponent;
use App\Http\Livewire\Admin\AdminEditBlogComponent;
use App\Http\Livewire\Admin\AdminEditExerciseVideoComponent;
use App\Http\Livewire\Admin\AdminEditProgramDayRoutineComponent;
use App\Http\Livewire\Admin\AdminExerciseVideoComponent;
use App\Http\Livewire\Admin\AdminProgramComponent;
use App\Http\Livewire\Admin\AdminProgramDayRoutineComponent;
use App\Http\Livewire\Admin\AdminUserComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('success',[HomeController::class,'success']);
Route::get('cancel',[HomeController::class,'cancel']);
/*Route::get('/', function () {
    return view('auth.login');
});
*/

Route::get('/', \Filament\Http\Livewire\Auth\Login::class);

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dash', function () {
    return view('dash.index');
})->name('dash');
*/



Route::get('/dash','App\Http\Controllers\DashboardController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dash/crud', function () {
    return view('crud.index');
})->name('dash');

Route::middleware(['auth:sanctum', 'verified'])->get('/dash/crud/create', function () {
    return view('crud.create');
})->name('dash');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    /*
    Route::get('/admin/programs', AdminProgramComponent::class)->name("admin.programs");
    Route::get('/admin/program/add', AdminAddProgramComponent::class)->name("admin.addprogram");
    Route::get('/admin/program/edit/{program_id}', AdminEditProgramComponent::class)->name("admin.editprogram");
    */

    Route::get('/admin/blogs', AdminBlogComponent::class)->name("admin.blogs");
    Route::get('/admin/blog/add', AdminAddBlogComponent::class)->name("admin.addblog");
    Route::get('/admin/blog/edit/{blog_id}', AdminEditBlogComponent::class)->name("admin.editblog");

    Route::get('/admin/programdayroutines', AdminProgramDayRoutineComponent::class)->name("admin.programdayroutines");
    Route::get('/admin/programdayroutine/add', AdminAddProgramDayRoutineComponent::class)->name("admin.addprogramdayroutine");
    Route::get('/admin/programdayroutine/edit/{programdayroutine_id}', AdminEditProgramDayRoutineComponent::class)->name("admin.editprogramdayroutine");

    Route::get('/admin/exercisevideos', AdminExerciseVideoComponent::class)->name("admin.exercisevideos");
    Route::get('/admin/exercisevideos/add', AdminAddExerciseVideoComponent::class)->name("admin.addexercisevideo");
    Route::get('/admin/exercisevideos/edit/{exercisevideo_id}', AdminEditExerciseVideoComponent::class)->name("admin.editexercisevideo");

    //Route::get('/admin/users', AdminUserComponent::class)->name("admin.adminusers");

});    

Route::resource('countries', CountryController::class)->middleware([ 'auth','verified']);
Route::resource('genders', GenderController::class)->middleware([ 'auth','verified']);
Route::resource('statuses', StatusController::class)->middleware([ 'auth','verified']);
Route::resource('packages', PackageController::class)->middleware([ 'auth','verified']);
Route::resource('program-categories', ProgramCategoryController::class)->middleware([ 'auth','verified']);
Route::resource('programs', ProgramController::class)->middleware([ 'auth','verified']);
Route::resource('subscriptions', SubscriptionController::class)->middleware([ 'auth','verified']);
Route::resource('subscription-programs', SubscriptionProgramController::class)->middleware([ 'auth','verified']);
Route::resource('program-days', ProgramDayController::class)->middleware([ 'auth','verified']);
Route::resource('subscription-program-day-routines', SubscriptionProgramDayRoutineController::class)->middleware([ 'auth','verified']);
Route::resource('routine-logs', RoutineLogController::class)->middleware([ 'auth','verified']);
Route::resource('comments', CommentController::class)->middleware([ 'auth','verified']);
Route::resource('payment-histories', PaymentHistoryController::class)->middleware([ 'auth','verified']);
Route::resource('blogs', BlogController::class)->middleware([ 'auth','verified']);
Route::resource('frequently-asked-questions', FrequentlyAskedQuestionController::class)->middleware([ 'auth','verified']);
Route::resource('user-cards', UserCardController::class)->middleware([ 'auth','verified']);
Route::resource('exercises', ExerciseController::class)->middleware([ 'auth','verified']);
Route::resource('exercise-logs', ExerciseLogController::class)->middleware([ 'auth','verified']);
Route::resource('exercise-videos', ExerciseVideoController::class)->middleware([ 'auth','verified']);
Route::resource('program-day-routines', ProgramDayRoutineController::class)->middleware([ 'auth','verified']);



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AvailabilityTypeController;
use App\Http\Controllers\EmployeeStatusController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ForeignerController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CertificateTypeController;
use App\Http\Controllers\CertificateSpecializationController;
use App\Http\Controllers\CertificateCountryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\IustCourseIntitledController;
use App\Http\Controllers\TaughtCourseController;
use App\Http\Controllers\IustCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PalestiniansController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LifeEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;


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

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
// Email Verification Routes... (Laravel 5.7+)
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
/////

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth')->get('/user/permissions', function () {
    if (Auth::check()) {
        $permissions = Auth::user()->getAllPermissions()->pluck('name');
        return response()->json(['permissions' => $permissions]);
    }
    return response()->json(['error' => 'Unauthorized'], 401);
});
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});
Route::resource('roles', RoleController::class);
// Employees CRUD Routes
Route::resource('employees', EmployeeController::class);

// Additional custom routes if needed
Route::get('employees/{employee}/profile', [EmployeeController::class, 'showProfile'])->name('employees.profile');
// Positions CRUD Routes
Route::resource('positions', PositionController::class);
Route::resource('availability-types', AvailabilityTypeController::class);
Route::resource('employee-statuses', EmployeeStatusController::class);
Route::resource('regions', RegionController::class);

Route::resource('cities', CityController::class);

Route::resource('majors', MajorController::class);

Route::resource('faculties', FacultyController::class);


Route::resource('foreigners', ForeignerController::class);
// routes/web.php



Route::resource('universities', UniversityController::class);

Route::resource('certificate-types', CertificateTypeController::class);


Route::resource('certificate-specializations', CertificateSpecializationController::class);


Route::resource('certificate-countries', CertificateCountryController::class);


Route::resource('certificates', CertificateController::class);
Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');



Route::prefix('iust-courses-intitled')->name('iust-courses-intitled.')->group(function () {
    Route::get('/', [IustCourseIntitledController::class, 'index'])->name('index');
    Route::get('/create', [IustCourseIntitledController::class, 'create'])->name('create');
    Route::post('/', [IustCourseIntitledController::class, 'store'])->name('store');
    Route::get('/{iustCourseIntitled}', [IustCourseIntitledController::class, 'show'])->name('show');
    Route::get('/{iustCourseIntitled}/edit', [IustCourseIntitledController::class, 'edit'])->name('edit');
    Route::put('/{iustCourseIntitled}', [IustCourseIntitledController::class, 'update'])->name('update');
    Route::delete('/{iustCourseIntitled}', [IustCourseIntitledController::class, 'destroy'])->name('destroy');
});


Route::resource('iust-courses', IustCourseController::class);

Route::resource('taught-courses', TaughtCourseController::class)
    ->parameters([
        'taught-courses' => 'taughtCourse'
    ]);
  

Route::resource('courses', CourseController::class);
// Palestinians Routes
Route::resource('palestinians', PalestiniansController::class);
Route::resource('events', EventController::class);
Route::resource('life-events', LifeEventController::class);
Route::resource('contacts', ContactController::class);
Route::resource('contact-types', ContactTypeController::class);


// Role Management Routes
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    
    // Optional - if you want to restrict these to admin only
    Route::middleware(['admin'])->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });
});
// User Management Routes
Route::resource('users', UserController::class);
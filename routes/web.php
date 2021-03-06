<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\HistoryController;


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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', 'HomeController@index');

// Route::get('/schedule', [ScheduleController::class, 'index'])->middleware('role:user')->name('schedule');

// Auth::routes();
// Route::group(['middleware' => 'role:admin'], function () {
//     Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // Route::group(['prefix' => 'users'], function(){
    //     // Route::get('/', [UserController::class, 'index'])->name('users.index');
    //     Route::post('/storeUserOfficeBoy', [UserController::class, 'store'])->name('users.store');
    //     Route::get('/{id}/editOfficeBoy', [UserController::class, 'edit'])->name('users.edit');
    //     // Route::put('/{id}/editProfile', [UserController::class, 'editProfile'])->name('users.editProfile');
    //     Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    //     Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    // });
// });
// Route::group(['middleware' => 'role:user'], function () {
//     Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

// });
// Route::group(['middleware' => ['auth']], function() {
//  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//  Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
//  Route::get('/users', [UserController::class, 'index'])->name('users.index');
//  });

// Route::group(['prefix' => 'schedule'], function(){
//     // Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
//     Route::get('/{id}/editSchedule', [ScheduleController::class, 'edit'])->name('schedule.edit');
//     Route::get('/{id}/editScheduleUser', [ScheduleController::class, 'editUser'])->name('schedule.editUser');
//     Route::put('/{id}/updateScheduleUser', [ScheduleController::class, 'updateUser'])->name('schedule.updateUser');
//     Route::post('/storeSchedule', [ScheduleController::class, 'store'])->name('schedule.store');
//     Route::delete('/deleteSchedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.delete');
//     Route::put('/updateSchedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');

//         Route::put('/{id}/editProfile', [UserController::class, 'editProfile'])->name('users.editProfile');
// });

// Route::group(['prefix' => 'history'],function () {
//     Route::get('/', 'HistoryController@index')->name('history.index');
//     Route::delete('delete/{id}','HistoryController@destroy')->name('history.destroy');
// });




Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'schedule'], function(){
        Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/{id}/editSchedule', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::get('/{id}/editScheduleUser', [ScheduleController::class, 'editUser'])->name('schedule.editUser');
        Route::put('/{id}/updateScheduleUser', [ScheduleController::class, 'updateUser'])->name('schedule.updateUser');
        Route::post('/storeSchedule', [ScheduleController::class, 'store'])->name('schedule.store');
        Route::delete('/deleteSchedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.delete');
        Route::put('/updateSchedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
        Route::put('/{id}/editProfile', [UserController::class, 'editProfile'])->name('users.editProfile');
    });


    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/storeUserOfficeBoy', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/editOfficeBoy', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    });

    Route::group(['prefix' => 'history'],function () {
        Route::get('/', 'HistoryController@index')->name('history.index');
        Route::delete('delete/{id}','HistoryController@destroy')->name('history.destroy');
    });
});

Auth::routes();
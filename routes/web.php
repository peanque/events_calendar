<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

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
Route::get('/', [CalendarController::class, 'index']);
Route::get('/calendar/event/list', [CalendarController::class, 'month_component_list']);
Route::get('/{url}', [CalendarController::class, 'index']);

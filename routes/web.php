<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoblistController;

Route::get('/', [HomeController::class, 'viewHome'])->name('home');
Route::post('/jobs/{jobId}/add-candidat', [
    HomeController::class, 'addCandidate'
])->name('addCandidate');

Route::get('/joblist', [JoblistController::class, 'viewJobs'])->name('joblist');


<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
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
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::get('/candidate', [CandidateController::class, 'showCandidate'])->name('candidate');
Route::get('/newcandidate', [CandidateController::class, 'newCandidate'])->name('newcandidate');
Route::post('/addcandidate', [CandidateController::class, 'addCandidate'])->name('add.candidate');
Route::get('/candidates/{id}/edit#candidate_hobby', [CandidateController::class, 'editHobby'])->name('candidates.edit_candidate#candidate_hobby');
Route::get('/delete/{id}', [CandidateController::class, 'deleteCandidate'])->name('delete.candidate');
Route::get('/candidates/{id}/edit', [CandidateController::class, 'editCandidate'])->name('edit.candidate');
Route::post('/update/candidate/{id}', [CandidateController::class, 'updateCandidate'])->name('update.candidate');

// category
Route::get('/category', [CategoryController::class, 'showCategory'])->name('category');
Route::post('/add/category', [CategoryController::class, 'addCategory'])->name('add.category');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

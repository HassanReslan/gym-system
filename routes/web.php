<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('/members', MemberController::class)->names(['index'=>'members.list','edit'=>'members.edit','create'=>'members.create']);
Route::resource('/subscriptions', SubscriptionController::class)->names(['index'=>'subscriptions.index','edit'=>'subscriptions.edit','create'=>'subscriptions.create']);
Route::resource('/trainers', TrainerController::class)->names(['index'=>'trainers.index','edit'=>'trainers.edit','create'=>'trainers.create']);
Route::resource('/plans', PlanController::class)->names(['index'=>'plans.index','edit'=>'plans.edit','create'=>'plans.create']);
Route::resource('/sessions', SessionController::class)->names(['index'=>'sessions.index','edit'=>'sessions.edit','create'=>'sessions.create']);

Route::post('/members/upload-image', [MemberController::class, 'uploadImage'])->name('members.upload-image');

Route::post('/members/{id}/upload-image', [MemberController::class, 'uploadImageEdit'])->name('members.upload.image');

Route::post('/trainers/upload-image', [TrainerController::class, 'uploadImage'])->name('trainers.upload-image');
Route::post('/trainers/{id}/upload-image', [TrainerController::class, 'uploadImageEdit'])->name('trainers.upload.image');
require __DIR__.'/auth.php';

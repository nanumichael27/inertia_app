<?php

use App\Http\Controllers\TopicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
Route::get('/topics/{topic}/delete', [TopicController::class, 'destroy'])->name('topics.destroy');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');


require __DIR__.'/auth.php';

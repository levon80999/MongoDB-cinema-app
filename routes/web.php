<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\ProducerController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\User\HomeController;
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

Route::get('/', [HomeController::class, 'main'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('film/{id}', [HomeController::class, 'filmView'])->name('film.view');
Route::get('producer/{id}', [HomeController::class, 'producerView'])->name('producer.single');
Route::get('actor/{id}', [HomeController::class, 'actorView'])->name('actor.single');
Route::get('choose-session/{id}', [HomeController::class, 'chooseSession'])->name('sessions.choose');
Route::get('book-session/{sessionId}', [HomeController::class, 'bookSession'])->name('book_session');
Route::post('book', [HomeController::class, 'book'])->name('book');

Route::prefix('admin')->group(function () {
    // Films crud
    Route::get('films', [FilmController::class, 'list'])->name('films.list');
    Route::get('films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('films', [FilmController::class, 'store'])->name('films.store');
    Route::get('films/{id}', [FilmController::class, 'edit'])->name('films.edit');
    Route::post('films/update/{id}', [FilmController::class, 'update'])->name('films.update');
    Route::get('films/destroy/{id}', [FilmController::class, 'destroy'])->name('films.destroy');

    // Actors crud
    Route::get('actors', [ActorController::class, 'list'])->name('actors.list');
    Route::get('actors/create', [ActorController::class, 'create'])->name('actors.create');
    Route::post('actors', [ActorController::class, 'store'])->name('actors.store');
    Route::get('actors/{id}', [ActorController::class, 'edit'])->name('actors.edit');
    Route::post('actors/update/{id}', [ActorController::class, 'update'])->name('actors.update');
    Route::get('actors/destroy/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');

    // Producers crud
    Route::get('producers', [ProducerController::class, 'list'])->name('producers.list');
    Route::get('producers/create', [ProducerController::class, 'create'])->name('producers.create');
    Route::post('producers', [ProducerController::class, 'store'])->name('producers.store');
    Route::get('producers/{id}', [ProducerController::class, 'edit'])->name('producers.edit');
    Route::post('producers/update/{id}', [ProducerController::class, 'update'])->name('producers.update');
    Route::get('producers/destroy/{id}', [ProducerController::class, 'destroy'])->name('producers.destroy');

    // Halls crud
    Route::get('halls', [HallController::class, 'list'])->name('halls.list');
    Route::get('halls/create', [HallController::class, 'create'])->name('halls.create');
    Route::post('halls', [HallController::class, 'store'])->name('halls.store');
    Route::get('halls/{id}', [HallController::class, 'edit'])->name('halls.edit');
    Route::post('halls/update/{id}', [HallController::class, 'update'])->name('halls.update');
    Route::get('halls/destroy/{id}', [HallController::class, 'destroy'])->name('halls.destroy');

    // Sessions crud
    Route::get('sessions/list', [SessionController::class, 'list'])->name('sessions.list');
    Route::get('sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('sessions', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('sessions/{id}', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::post('sessions/update/{id}', [SessionController::class, 'update'])->name('sessions.update');
    Route::get('sessions/destroy/{id}', [SessionController::class, 'destroy'])->name('sessions.destroy');
});

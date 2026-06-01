<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Auth::routes();

Route::get('/setLanguage/{lang}', [LanguageController::class, 'setLanguage'])->name('setLanguage');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::get('/articles/filter', [ArticleController::class, 'filter'])->name('articles.filter');
});

<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;

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

// request()->server->add(['REMOTE_ADDR'=>'127.0.0.4 ']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('articles.index', [
        'articles' => Article::query()
            ->orderBy('view_count', 'desc')
            ->get(),
    ]);
});

Route::get('/articles/{article}', function (Article $article) {
    $article->logView();

    return view('articles.show', [
        'article' => $article
    ]);
})->name('articles.show');


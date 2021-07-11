<?php

use App\Http\Controllers\AdiantamentoController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AxieController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\MetaDiariaController;
use App\Http\Controllers\JogadorController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\PagamentoController;

use Illuminate\Support\Facades\Route;

//Route::middleware(['auth'])->group(	function(){
Route::group(['middleware' => ['auth']], function() {
    Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::resource('projetos', ProjetosController::class);
    Route::any('/projetos/search', [ProjetosController::class, 'search'])->name('projetos.search');

    Route::resource('tipo_despesas', TipoDespesaController::class);
    Route::resource('despesas', DespesasController::class);


    Route::resource('adiantamentos', AdiantamentoController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);


    Route::resource('account', AxieController::class);
    Route::resource('metas', MetaDiariaController::class);
    Route::resource('player', JogadorController::class);
    Route::resource('financeiro', FinanceiroController::class);
    Route::resource('pagamentos', PagamentoController::class);
    Route::resource('config', ConfigController::class);


    Route::resource('relatorios', RelatorioController::class);

    Route::any('/relatorios/searchMonth/{id}', [RelatorioController::class, 'searchMonth'])->name('relatorios.searchMonth');

    Route::get('/', function (){
        return view('welcome');
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


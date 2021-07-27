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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/clientes/cadastrar', 'ClientesController@index')->name('clientes.cadastrar');
    Route::post('/clientes/save', 'ClientesController@cadastrar')->name('clientes.save');
    Route::get('/clientes/todos', 'ClientesController@lista')->name('clientes.todos');
    Route::post('/cliente/editar', 'ClientesController@editar')->name('clientes.editar');
    Route::post('/cliente/saveeditar', 'ClientesController@saveEditar')->name('clientes.saveEdit');

    // Parametros Estoque
    Route::get('/estoque/cadastrar', 'EstoqueController@index')->name('estoque.cadastrar');
    Route::post('/estoque/save', 'EstoqueController@cadastrar')->name('estoque.save');

    
    // Parametros Atributos
    Route::get('/estoque/modal', 'EstoqueController@viewModal')->name('estoque.atributos.modal');
    Route::post('/estoque/somente-add', 'EstoqueController@addAtributo')->name('estoque.atributos.add');
    Route::get('/estoque/somente/{id}', 'EstoqueController@viewAtributos')->name('estoque.atributos');
    Route::post('ap/estoque/find', 'EstoqueController@APIprocurarEstoqueID')->name('estoque.api.estoqueID');

    // API ESTOQUE
    Route::get('ap/estoque/{id}', 'EstoqueController@APIFind')->name('estoque.api.find');

});
Route::get('/mailable', function () { });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

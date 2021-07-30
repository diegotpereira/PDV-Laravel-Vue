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
    Route::get('/estoque/todos', 'EstoqueController@lista')->name('estoque.todos');

    
    // Parametros Atributos
    Route::get('/estoque/modal', 'EstoqueController@viewModal')->name('estoque.atributos.modal');
    Route::post('/estoque/somente-add', 'EstoqueController@addAtributo')->name('estoque.atributos.add');
    Route::get('/estoque/somente/{id}', 'EstoqueController@viewAtributos')->name('estoque.atributos');
    Route::get('/estoque/atributos', 'EstoqueController@viewAlterarAtributo')->name('estoque.editar.atributos');
    Route::post('/estoque/atributos', 'EstoqueController@saveAlterarAtributos')->name('estoque.editar.atributos');

    // API ESTOQUE
    Route::get('ap/estoque/', 'EstoqueController@APIListar')->name('estoque.api.listar');
    Route::post('ap/estoque/disponivel', 'EstoqueController@APIDisponivel')->name('estoque.api.disponivel');
    Route::get('ap/estoque/{id}', 'EstoqueController@APIFind')->name('estoque.api.find');
    Route::post('ap/estoque/', 'EstoqueController@saveEditar')->name('estoque.api.save');
    Route::post('ap/estoque/delete', 'EstoqueController@APIapagar')->name('estoque.api.delete');
    Route::post('ap/estoque/find', 'EstoqueController@APIprocurarEstoqueID')->name('estoque.api.estoqueID');

    //Historico
    Route::get('/historico/', 'CaixaController@historico')->name('historico');
    Route::post('/historico/imprimir', 'CaixaController@historicoPrint')->name('historico.print');
    //Historico API
    Route::get('ap/historico/{type}/{id}', 'CaixaController@historicoAPI')->name('historico.api');
    Route::post('ap/historico/', 'CaixaController@historicoAPI')->name('historico.route');

});
Route::get('/mailable', function () { });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

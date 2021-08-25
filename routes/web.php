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


Route::middleware(['userLogat'])->group(function() {
    Route::get('cont', 'ContController@cont');
  });
Route::get('/', 'IndexController@index');
Route::get('overlays', 'IndexController@overlays');
Route::get('termeni', 'IndexController@termeni');
Route::get('despre', 'IndexController@despre');
Route::get('restaurant', 'IndexController@restaurant');
Route::get('contact', 'IndexController@contact');
Route::get('404', 'IndexController@noPage');
Route::get('detaliu-pizza/{id}', 'PizzaController@detaliuPizza');
Route::get('detaliu-paste/{id}', 'PasteController@detaliuPaste');
Route::get('detaliu-salata/{id}', 'SalataController@detaliuSalata');
Route::get('detaliu-sandwich/{id}', 'SandwichController@detaliuSandwich');
Route::get('detaliu-desert/{id}', 'DesertController@detaliuDesert');
Route::get('detaliu-bautura/{id}', 'BauturaController@detaliuBautura');
Route::get('cos', 'CartController@cos');
Route::get('comanda-incheiata/{id}', 'IndexController@comandaIncheiata');
Route::get('pizza', 'PizzaController@pizza');
Route::get('paste', 'PasteController@paste');
Route::get('salate', 'SalataController@salate');
Route::get('sandwichuri', 'SandwichController@sandwichuri');
Route::get('deserturi', 'DesertController@deserturi');
Route::get('bauturi', 'BauturaController@bauturi');

//cart
Route::post('/adauga_rapid','CartController@quck_add');
Route::post('/sterge_rapid','CartController@quck_remove');
Route::post('/finalizeaza/tot','CartController@update_cart');
Route::post('/modifica_cantitate','CartController@modifica_cantitate');
Route::post('/modifica_extra','CartController@modifica_extra');
Route::post('/get-extra','CartController@get_extra');
Route::post('/trimite-comanda','CartController@trimite_comanda');

//cont
Route::post('/register','ContController@register');
Route::post('/login','ContController@login');
Route::post('/logout','ContController@logout');
Route::post('/modifica-datele','ContController@modifica_datele');
//cont-adresa
Route::post('/modifica-adresa','ContController@modifica_adresa');
Route::post('/sterge-adresa','ContController@sterge_adresa');
Route::post('/sterge-adresa','ContController@sterge_adresa');
Route::post('/adauga-adresa','ContController@adauga_adresa');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

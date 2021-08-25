<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Cart;
use App\Conturi;
use App\Comenzi;
use App\Pizza;
use App\ExternalApi\ProductsApi;
class IndexController extends Controller
{
  public function index(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    $ProductsApi = new ProductsApi();
    $pizzas = $ProductsApi->getPizzas();
    $pizza_db = Pizza::get();
    foreach($pizzas['products'] as $key => $product){
      foreach($pizza_db as $db){
        if($db->id_api == $product['productId']){
          $pizzas['products'][$key]['image'] = $db->imagine;
        }
      }
    }
    return view('index', ["pizzas"=>$pizzas, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function termeni(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    return view('termeni', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function despre(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    
    return view('despre', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function restaurant(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    
    return view('restaurant', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function contact(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    
    return view('contact', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function noPage(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    
    return view('no-page', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
  public function comandaIncheiata($id){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    $comanda = Comenzi::where('api_id', $id)->first();
    if(!$comanda) return abort(404);
    if($comanda->conturi_id != session('userid')) return abort(404);
    return view('comanda-incheiata', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare, 'comanda' => $comanda]);
    
  }
  
  public function overlays(){
    $numaratoare = Cart::count();
    $total_cart = Cart::total();
    
    return view('overlays', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    
  }
}
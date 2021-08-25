<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Pizza;
use App\Sos;
use App\ExtraToppingsPizza;
use TCG\Voyager\Facades\Voyager;

class PizzaController extends Controller{
    public function pizza(){
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
        return view('pizza',  ["pizzas"=>$pizzas, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    }
    public function detaliuPizza($id){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $detaliu_pizza = $ProductsApi->getDetaliuPizza($id);
        $detaliu_pizzaXXL = $ProductsApi->getDetaliuPizza($id+1);
        $detaliu_pizza['priceXXL'] = $detaliu_pizzaXXL['price'];
        $detaliu_pizza['idXXL'] = $detaliu_pizzaXXL['productId'];
        $sosuri = $ProductsApi->getSosuri()['products'];
        $sosuri_db = Sos::get();
        //       dd($sosuri_db);
        foreach($sosuri as $key => $product){
            foreach($sosuri_db as $db){
                if($db->id_api == $product['productId']){
                    $sosuri[$key]['image'] = $db->imagine;
                    $sosuri[$key]['description'] = $db->descriere;
                }
            }
        }
        $extraToppingsPizza = $ProductsApi->getExtraToppingsPizza();
        $extraToppingsPizza_db = ExtraToppingsPizza::get();
        //       dd($extraToppingsPizza_db);
        foreach($extraToppingsPizza as $key => $product){
            foreach($extraToppingsPizza_db as $db){
                if($db->id_api == $product['productId']){
                    $extraToppingsPizza[$key]['image'] = $db->imagine;
                }
            }
        }
        $pizza_db = Pizza::where("id_api", $id)->first();
        if(isset($pizza_db)){
            
            $detaliu_pizza['image'] = $pizza_db->imagine;
            $detaliu_pizza['ingredienteBlocate'] = json_decode($pizza_db->ingrediente);
            $detaliu_pizza['toppinguriBlocate'] = json_decode($pizza_db->toppings);
        }
        return view('detaliu-pizza', ["detaliu_pizza"=>$detaliu_pizza, 'sosuri'=>$sosuri, "extraToppingsPizza"=>$extraToppingsPizza, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
        
    }
}
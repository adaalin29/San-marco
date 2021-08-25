<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Sandwich;
use App\ExtraToppingsPizza;
use TCG\Voyager\Facades\Voyager;

class SandwichController extends Controller{
    public function sandwichuri(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $sandwichuri = $ProductsApi->getSandwichuri();
        $sandwichuri_db = Sandwich::get();
        //       dd($sandwichuri_db);
        foreach($sandwichuri['products'] as $key => $product){
            foreach($sandwichuri_db as $db){
                if($db->id_api == $product['productId']){
                    $sandwichuri['products'][$key]['image'] = $db->imagine;
                    $sandwichuri['products'][$key]['description'] = $db->descriere;
                }
            }
        }
        return view('sandwichuri',  ["sandwichuri"=>$sandwichuri, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
        
    }
    public function detaliuSandwich($id){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $detaliu_sandwich = $ProductsApi->getDetaliuSandwich($id);
        $extraToppingsPizza = $ProductsApi->getExtraToppingsPizza();
        $sandwich_db = Sandwich::where("id_api", $id)->first();
        $extraToppingsPizza_db = ExtraToppingsPizza::get();
        foreach($extraToppingsPizza as $key => $product){
            foreach($extraToppingsPizza_db as $db){
                if($db->id_api == $product['productId']){
                    $extraToppingsPizza[$key]['image'] = $db->imagine;
                }
            }
        }
        if(isset($sandwich_db)){
            $detaliu_sandwich['image'] = $sandwich_db->imagine;
            $detaliu_sandwich['description'] = $sandwich_db->descriere;
            $detaliu_sandwich['ingredienteBlocate'] = json_decode($salata_db->ingrediente);
            $detaliu_sandwich['toppinguriBlocate'] = json_decode($salata_db->toppings);
        }
        return view('detaliu-sandwich', ["detaliu_sandwich"=>$detaliu_sandwich, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare, 'extraToppingsPizza' => $extraToppingsPizza]);
        
    }
}
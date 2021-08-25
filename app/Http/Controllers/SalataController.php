<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Salata;
use TCG\Voyager\Facades\Voyager;

class SalataController extends Controller{
    public function salate(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $salate = $ProductsApi->getSalate();
        $salate_db = Salata::get();
        //       dd($salate_db);
        foreach($salate['products'] as $key => $product){
            foreach($salate_db as $db){
                if($db->id_api == $product['productId']){
                    $salate['products'][$key]['image'] = $db->imagine;
                    $salate['products'][$key]['description'] = $db->descriere;
                }
            }
        }
        return view('salate',  ["salate"=>$salate, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
    }
    public function detaliuSalata($id){
        $numaratoare = Cart::count();
        //       dd($numaratoare);
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $detaliu_salata = $ProductsApi->getDetaliuSalate($id);
        $extraToppingsSalate = $ProductsApi->getExtraToppingsSalate();
        $salata_db = Salata::where("id_api", $id)->first();
        if(isset($salata_db)){
            $detaliu_salata['image'] = $salata_db->imagine;
            $detaliu_salata['description'] = $salata_db->descriere;
            $detaliu_salata['ingredienteBlocate'] = json_decode($salata_db->ingrediente);
            $detaliu_salata['toppinguriBlocate'] = json_decode($salata_db->toppings);
        }
        return view('detaliu-salata', ["detaliu_salata"=>$detaliu_salata, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare, 'extraToppingsSalate' => $extraToppingsSalate]);
        
    }
}
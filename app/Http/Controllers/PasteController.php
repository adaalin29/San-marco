<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Paste;

class PasteController extends Controller{
    public function paste(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $paste = $ProductsApi->getPaste();
        $paste_db = Paste::get();
        //       dd($paste_db);
        foreach($paste['products'] as $key => $product){
            foreach($paste_db as $db){
                if($db->id_api == $product['productId']){
                    $paste['products'][$key]['image'] = $db->imagine;
                    $paste['products'][$key]['description'] = $db->descriere;
                }
            }
        }
        return view('paste',  ["paste"=>$paste, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
        
    }
    public function detaliuPaste($id){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $detaliu_paste = $ProductsApi->getDetaliuPaste($id);
        $extraToppingsPaste = $ProductsApi->getExtraToppingsPaste();
        // $extraToppingsPaste_db = ExtraToppingsPaste::get();
        // foreach($extraToppingsPaste as $key => $product){
        //     foreach($extraToppingsPaste_db as $db){
        //         if($db->id_api == $product['productId']){
        //             $extraToppingsPaste[$key]['image'] = $db->imagine;
        //         }
        //     }
        // }
        $paste_db = Paste::where("id_api", $id)->first();
        if(isset($paste_db)){
            $detaliu_paste['image'] = $paste_db->imagine;
            $detaliu_paste['ingredienteBlocate'] = json_decode($paste_db->ingrediente);
            $detaliu_paste['toppinguriBlocate'] = json_decode($paste_db->toppings);
        }
        return view('detaliu-paste', ["detaliu_paste"=>$detaliu_paste, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare, 'extraToppingsPaste' => $extraToppingsPaste]);
        
    }
}
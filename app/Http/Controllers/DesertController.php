<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Desert;
use TCG\Voyager\Facades\Voyager;

class DesertController extends Controller{
    public function deserturi(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $deserturi = $ProductsApi->getDeserturi();
        $deserturi_db = Desert::get();
        //       dd($deserturi_db);
        foreach($deserturi['products'] as $key => $product){
            foreach($deserturi_db as $db){
                if($db->id_api == $product['productId']){
                    $deserturi['products'][$key]['image'] = $db->imagine;
                    $deserturi['products'][$key]['description'] = $db->descriere;
                }
            }
        }
        return view('deserturi',  ["deserturi"=>$deserturi, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
        
    }
}
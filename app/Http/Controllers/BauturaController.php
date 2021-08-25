<?php

namespace App\Http\Controllers;
use App\ExternalApi\ProductsApi;
use App\Http\Controllers\Controller;
use Cart;
use App\Bautura;
use TCG\Voyager\Facades\Voyager;

class BauturaController extends Controller{
    public function bauturi(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        $ProductsApi = new ProductsApi();
        $bauturi = $ProductsApi->getBauturi();
        $bauturi_db = Bautura::get();
        //       dd($bauturi_db);
        foreach($bauturi['products'] as $key => $product){
            foreach($bauturi_db as $db){
                if($db->id_api == $product['productId']){
                    $bauturi['products'][$key]['image'] = $db->imagine;
                    $bauturi['products'][$key]['description'] = $db->descriere;
                }
            }
        }
        return view('bauturi',  ["bauturi"=>$bauturi, 'total_cart' => $total_cart, 'numaratoare'=> $numaratoare]);
        
    }
}
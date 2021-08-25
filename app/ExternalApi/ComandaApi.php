<?php
namespace App\ExternalApi;

use GuzzleHttp\Client;

class ComandaApi {
    public function plaseazaComanda($products, $adresa, $total, $discount, $detalii, $metoda_plata, $clientId){
        $cashValue = 0;
        $cardValue = 0;
        $mealTicketValue = 0;
        $mealTicketCount = 0;
        if($metoda_plata == 1){
            $cashValue = $total;
        }elseif($metoda_plata == 2){
            $cardValue = $total;
        }
        $client = new Client();
        $response = $client->request(
            'GET',
            'http://5.2.224.122/app/', 
            [
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => ['max' => 10],
                'timeout' => 10,
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'body' => json_encode([
                    "products" => $products,
                    "street" => $adresa->strada,
                    "streetNumber" => $adresa->numar_strada,
                    "addrReference" => $adresa->reper,
                    "addrDetails" => $adresa->detalii,
                    "total" => $total,
                    "discount" => $discount,
                    "notes" => $detalii,
                    "payMethod" => $metoda_plata,
                    "cashValue" => $cashValue,
                    "cardValue" => $cardValue,
                    "mealTicketValue" => $mealTicketValue,
                    "mealTicketCount" => $mealTicketCount,
                    "clientId" => $clientId,

                    "action" => "placeOrder",
                    "internalOrderId" => md5(time().$clientId),
                    "authKey" => md5(time()."Smrc!020!9"),
                    "ts" => time(),
                ]),
            ]
        );
        return json_decode($response->getBody()->getContents() ,true);
    }

    public function getIdCentru($strada, $numar_strada){
        $client = new Client();
        $response = $client->request(
            'GET',
            'http://5.2.224.122/app/', 
            [
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => ['max' => 10],
                'timeout' => 10,
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'body' => json_encode([
                    "street" => $strada,
                    "streetNumber" => $numar_strada,

                    "action" => "getCenter",
                    "authKey" => md5(time()."Smrc!020!9"),
                    "ts" => time(),
                ]),
            ]
        );
        return json_decode($response->getBody()->getContents() ,true);
    }

    public function getStatusComanda($orderId, $clientId){
        $client = new Client();
        $response = $client->request(
            'GET',
            'http://5.2.224.122/app/', 
            [
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => ['max' => 10],
                'timeout' => 10,
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'body' => json_encode([
                    "orderId" => $orderId,
                    "clientId" => $clientId,

                    "action" => "fetchOrderStatus",
                    "authKey" => md5(time()."Smrc!020!9"),
                    "ts" => time(),
                ]),
            ]
        );
        return json_decode($response->getBody()->getContents() ,true);
    }
}
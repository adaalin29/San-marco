<?php
namespace App\ExternalApi;

use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class ContApi {
    public function registerClient($email, $password, $phone){
        $tempPassword = hash('sha256', $email.$password);
        $pwd = substr($tempPassword, 0, 10).substr($tempPassword, 42);
        $client = new Client();
        $response = $client->request(
            'POST',
            'http://5.2.224.122/app/', 
            [
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => ['max' => 10],
                'timeout' => 10,
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'body' => json_encode([
                    "email" => $email,
                    "pwd" => $pwd,
                    "pwd2" => md5($password),
                    "os" => "site",
                    "phone" => $phone,

                  "action" => "registerClient",
                  "authKey" => md5(time()."Smrc!020!9"),
                  "ts" => time(),
                ]),
            ]
        );
      return json_decode($response->getBody()->getContents() ,true);
    }
    public function updateClientInfo($nume, $prenume, $clientid, $phone){
        $client = new Client();
        $response = $client->request(
            'POST',
            'http://5.2.224.122/app/', 
            [
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => ['max' => 10],
                'timeout' => 10,
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'body' => json_encode([
                    "firstname" => $prenume,
                    "lastname" => $nume,
                    "phone" => $phone,
                    "clientId" => $clientid,

                  "action" => "updateClientInfo",
                  "authKey" => md5(time()."Smrc!020!9"),
                  "ts" => time(),
                ]),
            ]
        );
      return json_decode($response->getBody()->getContents() ,true);
    }
    public function login($email, $password){
        $tempPassword = hash('sha256', $email.$password);
        $pwd = substr($tempPassword, 0, 10).substr($tempPassword, 42);
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
                    "email" => $email,
                    "pwd2" => md5($password),
                    "pwd" => $pwd,
                    
                  "action" => "clientLogin",
                  "authKey" => md5(time()."Smrc!020!9"),
                  "ts" => time(),
                ]),
            ]
        );
      return json_decode($response->getBody()->getContents() ,true);
    }
}
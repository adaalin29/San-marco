<?php
namespace App\ExternalApi;

use GuzzleHttp\Client;

class ProductsApi {
    public function getAll(){
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
                  "action" => "fetchProductsInfo",
                  "authKey" => md5(time()."Smrc!020!9"),
                  "ts" => time(),
                ]),
            ]
        );
//       dd(json_decode($response->getBody()->getContents() ,true)['categories']);
      $all = json_decode($response->getBody()->getContents() ,true)['categories'];
      // dd($all);
      return $all;
    }
  
  public function getPizzas(){
        $categories = $this->getAll();
        $pizzaCategory = [];
        $pizzaWithoutSandwitch = [];
    foreach($categories as $category){
      if(str_contains($category['name'], 'PIZZA')){
        $pizzaCategory = $category;
      }
    }
    foreach($pizzaCategory['products'] as $product){
      if(str_contains($product['name'], 'PIZZA')){
        $product['categoryId'] = $pizzaCategory['categoryId'];
        array_push($pizzaWithoutSandwitch, $product);
      }
    }
    
    $pizzaCategory['products'] = $pizzaWithoutSandwitch;
    
    return $pizzaCategory;
  }
  
  public function getExtraToppingsPizza(){
    $categories = $this->getAll();
        $pizzaCategory = [];
        $pizzaWithoutSandwitch = [];
    foreach($categories as $category){
      if(str_contains($category['name'], 'PIZZA')){
        $pizzaCategory = $category;
      }
    }
    return $pizzaCategory['extraToppings'];
  }
  
  public function getSandwichuri(){
      $categories = $this->getAll();
        $pizzaCategory = [];
        $pizzaWithoutSandwitch = [];
    foreach($categories as $category){
      if(str_contains($category['name'], 'PIZZA')){
        $pizzaCategory = $category;
      }
    }
    foreach($pizzaCategory['products'] as $product){
      if(!(!str_contains($product['name'], 'SANDWICH') || str_contains($product['name'], 'DONATIE'))){
        $product['categoryId'] = $pizzaCategory['categoryId'];
        array_push($pizzaWithoutSandwitch, $product);
      }
    }
    
    $pizzaCategory['products'] = $pizzaWithoutSandwitch;
    
    return $pizzaCategory;
  }
  
  public function getSosuri(){
    $categories = $this->getAll();
    $sosCategory = [];
    $sosuri = [];
    foreach($categories as $category){
      if($category['name'] == 'SOSURI'){
        $sosCategory  = $category;
      }
    }
    foreach($sosCategory['products'] as $product){
        $product['categoryId'] = $sosCategory['categoryId'];
        array_push($sosuri, $product);
    }
    $sosCategory['products'] = $sosuri;
    return $sosCategory;
  }
  public function getDeserturi(){
    $categories = $this->getAll();
    $desertCategory = [];
    $deserturi = [];
    foreach($categories as $category){
      if($category['name'] == 'DESERT'){
        $desertCategory = $category;
        
      }
    }
    foreach($desertCategory['products'] as $product){
      $product['categoryId'] = $desertCategory['categoryId'];
      array_push($deserturi, $product);
    }
    $desertCategory['products'] = $deserturi;
    return $desertCategory;
  }
  public function getBauturi(){
    $categories = $this->getAll();
    $bauturiCategory = [];
    $bauturi = [];
    foreach($categories as $category){
      if($category['name'] == 'BAUTURI'){
        $bauturiCategory = $category;
      }
    }
    foreach($bauturiCategory['products'] as $product){
      $product['categoryId'] = $bauturiCategory['categoryId'];
      array_push($bauturi, $product);
    }
    $bauturiCategory['products'] = $bauturi;
    return $bauturiCategory;
  }
  
  public function getSalate(){
    $categories = $this->getAll();
    $salateCategory = [];
    $onlySalate = [];
    foreach($categories as $category){
//       echo $category['name'];
      if(str_contains($category['name'], 'SALATE')){
        $salateCategory =  $category;
      }
    }
    foreach($salateCategory['products'] as $product){
      if(str_contains($product['name'], 'SALATA')){
        $product['categoryId'] = $salateCategory['categoryId'];
        array_push($onlySalate, $product);
      }
    }
    
    $salateCategory['products'] = $onlySalate;
    
    return $salateCategory;
  }
  public function getExtraToppingsSalate(){
    $categories = $this->getAll();
        $pizzaCategory = [];
        $pizzaWithoutSandwitch = [];
    foreach($categories as $category){
      if(str_contains($category['name'], 'SALATE')){
        $pizzaCategory = $category;
      }
    }
    return $pizzaCategory['extraToppings'];
  }
  public function getPaste(){
        $categories = $this->getAll();
        $pasteCategory = [];
        $onlyPaste = [];
    foreach($categories as $category){
//       echo $category['name'];
      if(str_contains($category['name'], 'PASTE')){
        $pasteCategory = $category;
      }
    }
    foreach($pasteCategory['products'] as $product){
      if(str_contains($product['name'], 'PASTE')){
        $product['categoryId'] = $pasteCategory['categoryId'];
        array_push($onlyPaste, $product);
      }
    }
    
    $pasteCategory['products'] = $onlyPaste;
    
    return $pasteCategory;
  }
  public function getExtraToppingsPaste(){
    $categories = $this->getAll();
        $pizzaCategory = [];
        $pizzaWithoutSandwitch = [];
    foreach($categories as $category){
      if(str_contains($category['name'], 'PASTE')){
        $pizzaCategory = $category;
      }
    }
    return $pizzaCategory['extraToppings'];
  }
  
  public function getDetaliuPizza($id){
    $pizza = $this->getPizzas();
    foreach($pizza['products'] as $produs){
      if($produs['productId'] == $id){
        return $produs;
      }
    }
  }
    public function getDetaliuPaste($id){
    $paste = $this->getPaste();
//     dd($pizza['extraToppings']);
    foreach($paste['products'] as $produs){
      if($produs['productId'] == $id){
        $produs['extraToppings'] = $paste['extraToppings'];
//       dd($produs);
        return $produs;
      }
    }
  }
   public function getDetaliuSalate($id){
    $salate = $this->getSalate();
//     dd($pizza['extraToppings']);
    foreach($salate['products'] as $produs){
      if($produs['productId'] == $id){
        $produs['extraToppings'] = $salate['extraToppings'];
//       dd($produs);
        return $produs;
      }
    }
  }
  public function getDetaliuSandwich($id){
    $sandwichuri = $this->getSandwichuri();
//     dd($pizza['extraToppings']);
    foreach($sandwichuri['products'] as $produs){
      if($produs['productId'] == $id){
//       dd($produs);
        return $produs;
      }
    }
  }
}
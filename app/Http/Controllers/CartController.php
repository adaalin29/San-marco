<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Validator;
use App\ExternalApi\ProductsApi;
use App\ExternalApi\ComandaApi;
use App\ExtraToppingsPizza;
use TCG\Voyager\Facades\Voyager;
use App\Conturi;
use App\Adrese;
use App\Comenzi;
use App\ProduseComanda;
use App\Puncte;

class CartController extends Controller{
	public function cos(){
		$numaratoare = Cart::count();
		$total_cart = Cart::total();
		$produse = Cart::content();
		$ProductsApi = new ProductsApi();
		$sosuri = $ProductsApi->getSosuri();
		$toppingPizza = $ProductsApi->getExtraToppingsPizza();
		$toppingPizza_db = ExtraToppingsPizza::get();
		//       dd($toppingPizza_db);
		foreach($toppingPizza as $key => $product){
			foreach($toppingPizza_db as $db){
				if($db->id_api == $product['productId']){
					$toppingPizza[$key]['image'] = $db->imagine;
				break;
				}
			}
		}
		if(session('userid')){
			$user = Conturi::with('adrese', 'puncte')->find(session('userid'));
		}else{
			$user = null;
		}
	return view('cos', ['total_cart' => $total_cart, 'toppingPizza'=>$toppingPizza,'sosuri'=>$sosuri, 'numaratoare'=> $numaratoare, 'produse'=>$produse, 'user' => $user]);
	}
// function update_cart(Request $request)
// {
	//      $cart_products = Cart::content();
	//      return['success' => true,'cart_products' => $cart_products];
	
	// }
	function update_cart(Request $request){
		
		$ProductsApi = new ProductsApi();
		$cart_products = Cart::content();
		$toppingPizza = $ProductsApi->getExtraToppingsPizza();
		$toppingPizza_db = ExtraToppingsPizza::get();
		//       dd($toppingPizza_db);
		foreach($toppingPizza as $key => $product){
			foreach($toppingPizza_db as $db){
				if($db->id_api == $product['productId']){
					$toppingPizza[$key]['image'] = $db->imagine;
				break;
			}
		}
	}
	return view('parts.coscontent', ['cart_products' =>  $cart_products, 'toppingPizza'=>$toppingPizza]);
	}
	public function quck_remove(Request $request){
		$form_data  = $request->only('id_product');
		$row_id = $form_data['id_product'];
		Cart::remove($row_id);
		
		return
		[
			
			'success'      => true,
			'msg'          => 'Produsul a fost adaugat cu succes in cos.',
			'code'     => 200,
			'count_prods'  => Cart::count(),
			'total' => Cart::total(),
		];
	}

public function quck_add(Request $request){
	$form_data  = $request->only('id_product', 'name', 'price', 'options');
	$id_product = $form_data['id_product'];
	$name = $form_data['name'];
	$price = $form_data['price'];
	$options = $form_data['options'];
	$total = $options['price'];
	if(isset($options['extra'])){
		if(str_contains($options['name'], "XXL")){
			foreach($options['extra'] as $topping){
				$total += $topping['price']*3;
			}
		}else{
			foreach($options['extra'] as $topping){
				$total += $topping['price'];
			}
		}
	}
	if(isset($options['sos'])){
		foreach($options['sos'] as $sos){
			$total += $sos['price']*$sos['cantitate'];
		}
	}
	Cart::add([
		'id'     => $id_product,
		'name'   => $name,
		'qty'    => 1,
		'price'  => $total,
		'weight' => 0,
		'options' => $options,
		]);
		
		return
		[
			'success'      => true,
			'msg'          => 'Produsul a fost adaugat cu succes in cos.',
			'count_prods'  => Cart::count(),
			'code'     => 200,
			'total' => Cart::total(),
		];				
	}
				
	public function modifica_cantitate(Request $request){
		$form_data = $request->only('rowId','cantitate');
		
		$validationRules = [
			'rowId'      => ['required'],
			'cantitate'  => ['required'],
		];    
		
		
		$validator = Validator::make($form_data, $validationRules);
		if ($validator->fails())
		{
			return ['success' => false, 'error_all' => $validator->errors()->toArray()]; 
		}
		else
		{
			$rowId     = $form_data['rowId'];
			$cantitate = $form_data['cantitate'];
			
			Cart::update($rowId, $cantitate);
			return
			[
				'code'           => 200,
				'sucess' => true,
				'count_prods'  => Cart::count(),
				'total' => Cart::total(),
			];
		}
	}

	public function modifica_extra(Request $request){
		$form_data = $request->only('rowId','extra');
		
		$validationRules = [
			'rowId'      => ['required'],
			'extra'  => ['required'],
		];    
		
		
		$validator = Validator::make($form_data, $validationRules);
		if ($validator->fails())
		{
			return ['success' => false, 'error_all' => $validator->errors()->toArray()]; 
		}
		else
		{
			$rowId     = $form_data['rowId'];
			$extra = json_decode($form_data['extra'], true);
			$produs = Cart::get($rowId);
			$options = $produs->options;
			$options['extra'] = $extra;
			$total = $produs->options['price'];
			$name = str_replace(" XXL", "",$produs->name);
			if(str_contains($options['name'], "XXL")){
				foreach($extra as $topping){
					$total += $topping['price']*3;
				}
			}else{
				foreach($extra as $topping){
					$total += $topping['price'];
				}
			}
			if(isset($options['sos'])){
				foreach($options['sos'] as $sos){
					$total += $sos['price']*$sos['cantitate'];
				}
			}
			$produs = Cart::update($rowId, ['price' => $total, 'name' => $name,'options' => $options]);
			return
			[
				'code'           => 200,
				'sucess' => true,
				'count_prods'  => Cart::count(),
				'total' => Cart::total(),
				'extra' => $extra,
				'rowid' => $produs->rowId,
			];
		}
	}

	public function get_extra(Request $request){
		$form_data = $request->only('rowId');
		
		$validationRules = [
			'rowId'      => ['required'],
		];    
		
		
		$validator = Validator::make($form_data, $validationRules);
		if ($validator->fails())
		{
			return ['success' => false, 'error_all' => $validator->errors()->toArray()]; 
		}
		else
		{
			$rowId     = $form_data['rowId'];
			$produs = Cart::get($rowId);
			$extra = $produs->options->extra;
			return
			[
				'code'           => 200,
				'sucess' => true,
				'count_prods'  => Cart::count(),
				'total' => Cart::total(),
				'extra' => $extra,
			];
		}
	}

	public function trimite_comanda(Request $request){
		$comandaApi = new ComandaApi();
		$form_data = $request->only('adresa', 'metodaPlata', 'puncte_folosite');
		
		$validationRules = [
			'adresa'      	=> ['required'],
			'metodaPlata'      => ['required'],
			'puncte_folosite'  => ['required'],
		];    
		
		
		
		$validator = Validator::make($form_data, $validationRules);
		if ($validator->fails()){
			return ['success' => false, 'error_all' => $validator->errors()->toArray()]; 
		}
		$adresa = Adrese::find($form_data['adresa']);
		$products = [];
		$total = 0;
		//  "products": [{
		// 		"productId": < id as int > ,
		// 		"categoryId": <categoryId as int>,
		// 		"optionals": [{
		// 			"name": "<optionalName>", // eg tip paste
		// 			"id": <optional id as int>
		// 		}],
		// 		"extras": [{
		// 			"id": <extras id as int> ,
		// 			"price": < extras price as numeric >
		// 		}],
		// 		"removed": [{
		// 			"toppingId": <topping id as int>
		// 			}, …], // empty array if client has no topping removed
		// 		"price": < price as numeric > , // price with extras. Removed toppings do not count.
		// 		"quantity": < quantity as int >,
		// 		"diner": < diner as string >, // name of person who ordered (if mentioned)
		// 	}],
			

		
		$metodaPlata = $form_data['metodaPlata'];
		$puncte_folosite = $form_data['puncte_folosite'];
		$cart = Cart::content();
		// return $cart;
		$detalii = 'Comanda Test';
		$client = Conturi::find(session('userid'));
		if(!$client)
		return[
			'success' => false,
			'msg' => 'Client inexistent',
		];
		$ProductsApi = new ProductsApi();
		$allRealItems = collect($ProductsApi->getAll());

		// return $allRealItems;
		$allRealProducts = $allRealItems->mapWithKeys(function ($item){
			return collect($item['products'])->keyBy('productId')->all();
		});
		$allRealExtra = $allRealItems->mapWithKeys(function ($item){
			return collect($item['extraToppings'])->keyBy('productId')->all();
		});
		
		foreach($cart as $produs){
			// dd($produs->options['price']);
			$product = [];
			$extras = [];
			$removed = [];
			$optionals = [];
			$realProduct = $allRealProducts->get($produs->id);
			if(!$realProduct)
			return[
				'success' => false,
				'msg' => 'Produs inexistent',
			];
			// dd($realProduct);
			$product['categoryId'] = $produs->options['categoryId'];
			$product['price'] = $realProduct['price'];
			$product['quantity'] = intval($produs->qty);
			$product['productId'] = intval($produs->id);
			if(isset($produs->options['extra'])){
				foreach($produs->options['extra'] as $extra){
					$topping = [];
					$realExtra = $allRealExtra->get($extra['productId']);
					if(!$realExtra)
					return[
						'success' => false,
						'msg' => 'Topping extra inexistent',
					];
					// dd($realExtra);
					if($realProduct['type'] == 1)
					$topping['price'] = $realExtra['price']*3;
					else
					$topping['price'] = $realExtra['price'];

					$product['price'] += $topping['price'];
					$topping['id'] = $realExtra['productId'];
					array_push($extras, $topping);
				}
			}
			if(isset($produs->options['optionals']) && count($produs->options['optionals']) > 0){
				$optional = [];
				$optional['name'] = $produs->options['optionals']['name'];
				$optional['id'] = $produs->options['optionals']['productId'];
				array_push($optionals, $optional);
			}
			if(isset($produs->options['removed']) && count($produs->options['removed']) > 0){
				$scos = [];
				foreach($produs->options['removed'] as $ingredient){
				$scos['toppingId'] = intval($ingredient['toppingId']);
				array_push($scos, $removed);
				}
				
				
			}
			if(isset($produs->options['sos'])){
				$sos = [];
				$soscategory = 31;
				foreach($produs->options['sos'] as $sos){
					$realProduct = $allRealProducts->get($sos['productId']);
					// return $realProduct;
					if(!$realProduct)
					return[
						'success' => false,
						'msg' => 'Sos inexistent',
					];

					$sos['categoryId'] = $soscategory;
					$sos['price'] = $realProduct['price'];
					$sos['quantity'] = $sos['cantitate']*$produs->qty;
					$sos['productId'] = $realProduct['productId'];
					$total += floatval($realProduct['price'])*floatval($sos['quantity']);
					unset($sos['cantitate']);
					array_push($products, $sos);
				}
			}

			$product['extra'] = $extras;
			$product['optionals'] = $optionals;
			$product['removed'] = $removed;

			$total += floatval($product['price'])*floatval($product['quantity']);
			array_push($products, $product);
		}
		$subtotal = $total;
		$pretTransport = 5;
		$numar_puncte_folosite = 0;
		if($form_data['puncte_folosite'] == 'true'){
			$puncte_client = $client->puncte()->get();
			$numar_puncte_folosite = $puncte_client->count();
			$total -= floatval($puncte_client->count());
			
		}
		$total += floatval($pretTransport);
		$responseComandaApi = $comandaApi->plaseazaComanda($products, $adresa, $total, 1, $detalii, $metodaPlata, $client->api_id);
		
		if($responseComandaApi['status'] == 0){
			return[
				'success' => false,
				'msg' => $responseComandaApi['error'],
			];
		}
		//sterge punctele folosite
		if($form_data['puncte_folosite'] == 'true'){
			foreach($puncte_client as $punct){
				$punct->folosit = 1;
				$punct->save();
			}
		}
		$puncte_cumulate = intval(($subtotal-$numar_puncte_folosite)/30);
		for($i = 1; $i <= $puncte_cumulate; $i++){
			$punct = new Puncte;
			$punct->conturi_id = $client->id;
			$punct->expires_at = now()->addYear(1);
			$punct->save();
		}
		$comanda = new Comenzi;
		$comanda->api_id = $responseComandaApi['orderId'];
		$comanda->conturi_id = $client->id;
		$comanda->total = $total;
		$comanda->status = 'inregistrata';
		$comanda->puncte_cumulate = $puncte_cumulate;
		$comanda->transport = $pretTransport;
		$comanda->discount_puncte = $numar_puncte_folosite;
		$comanda->sub_total = $subtotal;
		$comanda->save();
		// return $cart;
		foreach($cart as $produs){
			$produsComanda = new ProduseComanda;
			$produsComanda->comenzi_id = $comanda->id;
			$produsComanda->nume = $produs->name;
			$produsComanda->pret = $produs->options['price'];
			$produsComanda->options = $produs->options;
			$produsComanda->total = $produs->price*$produs->qty;
			$produsComanda->api_id = $produs->id;
			$produsComanda->cantitate = $produs->qty;
			
			
			if(isset($produs->options['sos'])){
				foreach($produs->options['sos'] as $sos){
					$produsComandaSos = new ProduseComanda;
					$produsComandaSos->comenzi_id = $comanda->id;
					$produsComandaSos->nume = $sos['name'];
					$produsComandaSos->pret = $sos['price'];
					$produsComandaSos->total = $sos['price']*($sos['cantitate']*$produs->qty);
					$produsComanda->total -= $produsComandaSos->total;
					$produsComandaSos->api_id = $sos['productId'];
					$produsComandaSos->cantitate = $sos['cantitate']*$produs->qty;
					$produsComandaSos->save();
				}
			}
			$produsComanda->save();
		}
		Cart::destroy();
		return[
			'success' => true,
			'comandaId' => $comanda->api_id,
		];
	}
}
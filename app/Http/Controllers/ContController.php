<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Cart;
use App\Conturi;
use DateTime;
use App\Adrese;
use App\ExternalApi\ContApi;
use Illuminate\Support\Facades\Hash;

class ContController extends Controller{
    
    public function cont(){
        $numaratoare = Cart::count();
        $total_cart = Cart::total();
        
        $user = Conturi::with('puncte', 'adrese', 'comenzi.produse')->find(session('userid'));
        if(!$user) return abort(404);

        // dd($user);
        return view('cont', ['total_cart' => $total_cart, 'numaratoare'=> $numaratoare, 'user' => $user]);
        
    }
    public function register(Request $request){
        $ProductsApi = new ContApi();
        $form_data = $request->only(['name', 'prenume', 'email', 'parola', 'telefon']);
        $validationRules = [
            'name'     => ['required', 'min:2'],
            'prenume'     => ['required', 'min:2'],
            'email'    => ['required', 'email', 'unique:conturi'],
            'parola' => ['required','min:6'],
            'telefon' =>  ['required', 'numeric', 'digits:10'],
        ];
        $customMessages = [
            'required' => 'Campul :attribute este obligatoriu.',
            'unique' => 'Exista deja un cont cu acest email.',
            'email' => 'Email nevalid.',
            'numeric' => 'Numarul de telefon este nevalid.',
            'min' => 'Campul :attribute trebuie sa fie de minim :min.',
            'digits' => 'Campul :attribute trebuie sa fie de minim :digits.',
        ];
        $validator = Validator::make($form_data, $validationRules, $customMessages);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()]; 

        //register user on the external api
        $externalApiResponse = $ProductsApi->registerClient($form_data['email'], $form_data['parola'], $form_data['telefon']);
        if ($externalApiResponse['status'] == 0)
            return ['success' => false, 'msg' => $externalApiResponse['error']];
        //update firstname and lastname on api
        $externalApiResponseUpdate = $ProductsApi->updateClientInfo($form_data['name'], $form_data['prenume'], $externalApiResponse['clientId'], $form_data['telefon']);
        if($externalApiResponseUpdate['status'] == 0)
            return ['success' => false, 'msg' => "eroare server"];
        // register new user
        $user = new Conturi;
        $user->email    = $form_data['email'];
        $user->nume    = $form_data['name'];
        $user->prenume    = $form_data['prenume'];
        $user->telefon    = $form_data['telefon'];
        $user->parola = Hash::make($form_data['parola']);
        $user->api_id    = $externalApiResponse['clientId'];
        $user->save();
        session(['userid' => $user->id]);
        return [
            'success' => true,
            'msg' => 'Cont creat cu success',
        ];
    }
    public function login(Request $request){
        $ProductsApi = new ContApi();
        $form_data = $request->only(['email', 'parola']);
        $validationRules = [
            'email'    => ['required', 'email'],
            'parola' => ['required','min:6']
        ];
        $customMessages = [
            'required' => 'Campul :attribute este obligatoriu.'
        ];
        $validator = Validator::make($form_data, $validationRules, $customMessages);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()];

        // //login on api
        // $externalApiResponse = $ProductsApi->login($form_data['email'], $form_data['parola']);
        // if ($externalApiResponse['status'] == 0)
        //     return ['success' => false, 'msg' => $externalApiResponse['error']];

        // dd($externalApiResponse);
        $user = Conturi::where('email', $form_data['email'])->first();
        if(!$user){
            return [
                'success' => false,
                'msg' => 'Email sau parola gresita',
            ];
        }
        if(!Hash::check($form_data['parola'], $user->parola)){
            return[
                'success' => false,
                'msg' => 'Email sau parola gresita',
            ];
        }
        session(['userid' => $user->id]);
        return [
            'success' => true,
            'msg' => 'to edit',
        ];
    }
    public function logout(Request $request){
        session(['userid' => null]);
        return [
            'success' => true,
            'msg' => 'to edit',
        ];
    }
    public function modifica_datele(Request $request){
        $ProductsApi = new ContApi();
        $form_data = $request->only(['nume', 'prenume', 'telefon']);
        $validationRules = [
            'nume'     => ['required', 'min:2'],
            'prenume'     => ['required', 'min:2'],
            'telefon' =>  ['required','min:10']
        ];
        $validator = Validator::make($form_data, $validationRules);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()];


        // register new user
        $user = Conturi::find(session('userid'));
        if(!$user){
            return [
                'success' => false,
                'msg' => 'Contul nu a fost gasit',
            ];
        }

        //edit user data on api
        $externalApiResponse = $ProductsApi->updateClientInfo($form_data['nume'], $form_data['prenume'], $user->api_id, $form_data['telefon']);
        if($externalApiResponse['status'] == 0)
            return ['success' => false, 'msg' => "eroare server"];


        $user->nume    = $form_data['nume'];
        $user->prenume    = $form_data['prenume'];
        $user->telefon    = $form_data['telefon'];
        $user->save();
        return [
            'success' => true,
            'msg' => 'Cont editat cu success',
        ];
    }
    public function modifica_adresa(Request $request){
        $form_data = $request->only(['id_adresa', 'strada', 'numar_strada', 'detalii', 'reper']);
        $validationRules = [
            'id_adresa'     => ['required'],
            'strada'     => ['required', 'min:2'],
            'numar_strada'     => ['required'],
            'detalii'    => ['required', 'min:2'],
        ];
        $validator = Validator::make($form_data, $validationRules);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()];  
        // register new user
        $user = Conturi::find(session('userid'));
        $adresa = $user->findaddres($form_data['id_adresa']);
        if(!$adresa){
            return [
                'success' => false,
                'msg' => 'Contul nu are aceasta adresa',
            ];
        }
        
        $adresa->strada    = $form_data['strada'];
        $adresa->numar_strada    = $form_data['numar_strada'];
        $adresa->detalii    = $form_data['detalii'];
        $adresa->reper    = $form_data['reper'];
        $adresa->save();
        return [
            'success' => true,
            'msg' => 'Adresa editat cu success',
            'strada' => $form_data['strada'],
            'numar_strada' => $form_data['numar_strada'],
            'detalii' => $form_data['detalii'],
            'reper' => $form_data['reper'],
        ];
    }
    public function adauga_adresa(Request $request){
        $form_data = $request->only(['strada', 'numar_strada', 'detalii', 'reper']);
        $validationRules = [
            'strada'     => ['required', 'min:2'],
            'numar_strada'     => ['required'],
            'detalii'    => ['required', 'min:2'],
        ];
        $validator = Validator::make($form_data, $validationRules);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()];  
        // register new user
        $adresa = new Adrese;
        $adresa->conturi_id = session('userid');
        $adresa->strada = $form_data['strada'];
        $adresa->numar_strada = $form_data['numar_strada'];
        $adresa->detalii = $form_data['detalii'];
        $adresa->reper = $form_data['reper'];
        $adresa->save();
        return [
            'success' => true,
            'msg' => 'Adresa editat cu success',
            'strada' => $form_data['strada'],
            'numar_strada' => $form_data['numar_strada'],
            'detalii' => $form_data['detalii'],
            'reper' => $form_data['reper'],
            'id' => $adresa->id,
        ];
    }
    public function sterge_adresa(Request $request){
        $form_data = $request->only(['id_adresa']);
        $validationRules = [
            'id_adresa'     => ['required'],
        ];
        $validator = Validator::make($form_data, $validationRules);
        if ($validator->fails())
        return ['success' => false, 'msg' => $validator->errors()->all()];  
        // register new user
        $user = Conturi::find(session('userid'));
        $adresa = $user->findaddres($form_data['id_adresa']);
        if(!$adresa){
            return [
                'success' => false,
                'msg' => 'Contul nu are aceasta adresa',
            ];
        }
        $adresa->delete();
        return [
            'success' => true,
            'msg' => 'Adresa stearsa cu success',
        ];
    }
}
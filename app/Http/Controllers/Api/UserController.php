<?php

namespace App\Http\Controllers\Api;

use Auth;
use Storage;
use Validator;
use Socialite;
use App\Conturi;
use App\Model\AppUser;
use App\Mail\AppUserForgotPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    
    // public function register(Request $request){
    //     $form_data = $request->only(['email', 'password', 'band_id']);
    //     $validationRules = [
    //         'email'     => ['required', 'email', 'unique:app_users'],
    //         'password'  => ['required', 'min:6'],
    //         'band_id'   => ['required'],
    //     ];
    //     $validationMessages = [
    //         // 'email'    => ':attribute-invalid',
    //         // 'required' => ':attribute-empty',
    //         // 'unique'   => ':attribute-existing',
    //         // 'min'      => ':attribute-min',
    //     ];
    //     $validator = Validator::make($form_data, $validationRules, $validationMessages);
    //     if ($validator->fails())
    //         return ['success' => false, 'error' => $validator->errors()->first()];
        
    //     // register new user
    //     $user = new AppUser;
    //     $user->email    = $form_data['email'];
    //     $user->password = Hash::make($form_data['password']);
    //     $user->band_id  = $form_data['band_id'];
    //     $user->goal_steps = 10000;
    //     $user->register_screen = 2;
        
    //     if (!$user->save())
    //         return ['success' => false, 'error' => 'unknown'];
        
    //     $token = $this->generateToken($user->email, $form_data['password']);
    //     if (!$token)
    //         return ['success' => false, 'error' => 'unknown'];
        
    //     return [
    //         'success' => true,
    //         'user' => $user,
    //         'token' => $token,
    //     ];
    // }
    public function login(Request $request)
    {
        if (!$request->email)
            return ['success' => false, 'error' => 'The email field is required.'];
        if (!$request->password)
            return ['success' => false, 'error' => 'The password field is required.'];
        
        $user = Conturi::where('email', $request->email)->first();
        if (!$user)
            return ['success' => false, 'error' => 'We can\'t find a user with that e-mail address.'];
        
        if ($user->password == 'oauth')
            return ['success' => false, 'error' => 'User account with that email has logged in only with Facebook or Google.'];
        
        if (!Hash::check($request->password, $user->parola))
            return ['success' => false, 'error' => 'These credentials do not match our records.'];
        
        //generare token si in register
        $token = $this->generateToken($user->email, $request->password);
        logger()->debug("generare token", (array)$token);
        if (!$token)
            return ['success' => false, 'error' => 'unknown'];
        
        $user->country;
        return [
            'success' => true,
            'user' => $user,
            'token' => $token,
        ];
    }
    //access user
    // $user = Auth::guard('api')->user();
   
    // public function facebook(Request $request)
    // {
    //     return $this->socialiteProvider('facebook', $request);
    // }
    // public function socialiteProvider($provider, $request)
    // {
    //     $token = $request->access_token;
    //     if (!$token)
    //         return ['success' => false, 'error' => 'unknown'];
        
    //     try {
    //         $oauthUser = Socialite::driver($provider)->userFromToken($token);
    //     }
    //     catch (\Exception $e) {
    //         return ['success' => false, 'error' => 'wrong-token'];
    //     }
    //     $user = AppUser::where('email', $oauthUser->getEmail())->first();
        
    //     if (!$user) {
    //         $user = new AppUser;
    //         $user->email     = $oauthUser->getEmail();
    //         $user->password  = 'oauth';
    //         $user->name      = $oauthUser->getName();
    //         $user->register_screen = 2;
    //         if (!$user->save())
    //             return ['success' => false, 'error' => 'unknown'];
    //     }
        
    //     if ($user->oauth()->where('provider', $provider)->count() < 1) {
    //         $user->oauth()->create([
    //             'provider' => $provider,
    //             'data' => [
    //                 'id'      => $oauthUser->getId(),
    //                 'email'   => $oauthUser->getEmail(),
    //                 'name'    => $oauthUser->getName(),
    //                 'avatar'  => $oauthUser->getAvatar(),
    //                 'token'   => $oauthUser->token,
    //             ],
    //         ]);
    //     }
        
    //     $token = $this->generateToken($user->email, encrypt('oauth'));
    //     if (!$token)
    //         return ['success' => false, 'error' => 'unknown'];
        
    //     return [
    //         'success' => true,
    //         'user' => $user,
    //         'token' => $token,
    //     ];
    // }
    
    
    private function generateToken($username, $password)
    {
        $http = new GuzzleClient;
        $response = $http->request('POST', url('/oauth/token'), [
            'allow_redirects' => true,
            'http_errors' => false,
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => env('OAUTH_PASSWORD_CLIENT_ID'),
                'client_secret' => env('OAUTH_PASSWORD_CLIENT_SECRET'),
                'username'      => $username,
                'password'      => $password,
                'scope'         => '*',
            ],
        ]);
        logger()->debug("generare",[ (string) $response->getBody()]);
        return json_decode((string) $response->getBody(), true);
    }
    
    
    public function checkToken(Request $request)
    {
        $guard = Auth::guard('api');
        $logged = $guard->check();
        $user = false;
        if ($logged) {
            $user =  $guard->user();
            $user->country;
        }
        if(!$user)$logged=false;
        return [
            'logged'  => $logged,
            'user'    => $user,
        ];
    }
    
    
    public function refreshToken(Request $request)
    {
        if (!$request->has('refresh_token'))
            return ['success' => false, 'error' => 'no-token'];
        
        $refresh_token = $request->refresh_token;
        $http = new GuzzleClient;
        $responseObj = $http->request('POST', url('/oauth/token'), [
            'allow_redirects' => true,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'grant_type'    => 'refresh_token',
                'client_id'     => env('OAUTH_PASSWORD_CLIENT_ID'),
                'client_secret' => env('OAUTH_PASSWORD_CLIENT_SECRET'),
                'refresh_token' => $refresh_token,
                'scope'         => '*',
            ],
        ]);
        $response = json_decode((string) $responseObj->getBody(), true);
        if (!$response) return ['success' => false, 'error' => 'unknown'];
        
        if (isset($response['error'])) {
            $return = ['success' => false, 'error' => 'unknown'];
            
            if ($response['error'] === 'invalid_request')
                $return['error'] = 'expired-token';
            
            if ($response['error'] === 'invalid_client') {
                // Sentry::captureException(new Exception('Internal oauth2 server, invalid client error.'), [
                //     'extra' => ['Response' => $response],
                // ]);
            }
            
            return $return;
        }
        
        // Note: action() will return the latest url with this action assigned
        $checkResponse = $http->request('GET', action('Api\UserController@checkToken'), [
            'allow_redirects' => true,
            'http_errors' => false,
            'headers' => [
                'Content-Type'   => 'application/json',
                'Accept'         => 'application/json',
                'Authorization'  => $response['token_type'].' '.$response['access_token'],
            ],
        ]);
        $check = json_decode((string) $checkResponse->getBody(), true);
        if(!$check['user'])
        return ['success' => false];
        return [
            'success' => true,
            'token'   => $response,
            'user'    => $check['user'],
        ];
    }
}

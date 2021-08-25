<?php

namespace App;
use Hash;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Conturi extends Authenticatable{
    use HasApiTokens;
    protected $table="conturi";
    protected $hidden=[
        'parola',
    ];
    

    public function validateForPassportPasswordGrant($password)
    {
        // $password can be user password or an oauth provider token
        if (Hash::check($password, $this->parola))
            return true;
        
        if (decrypt($password) == 'oauth')
            return true;
    }


    public function puncte()
    {
        return $this->hasMany('App\Puncte', 'conturi_id', 'id')->where('expires_at', '>=' , new DateTime())->where('folosit', 0);
    }
    public function adrese()
    {
        return $this->hasMany('App\Adrese', 'conturi_id', 'id');
    }
    public function findaddres($id){
        return $this->adrese()->where('id', $id)->first();
    }
    public function comenzi(){
        return $this->hasMany('App\Comenzi', 'conturi_id', 'id');
    }
}

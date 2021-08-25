<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comenzi extends Model
{
    protected $table="comenzi";

    public function produse()
    {
        return $this->hasMany('App\ProduseComanda', 'comenzi_id', 'id');
    }
}

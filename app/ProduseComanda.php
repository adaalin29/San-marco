<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProduseComanda extends Model
{
    protected $table="produse_comanda";

    public function comanda()
    {
        return $this->belongsTo('App\Comenzi', 'comenzi_id', 'id');
    }
}

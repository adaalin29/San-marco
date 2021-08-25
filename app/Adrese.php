<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Adrese extends Model
{
    protected $table="adrese";

    public function cont()
    {
        return $this->belongsTo('App\Conturi', 'conturi_id', 'id');
    }
}

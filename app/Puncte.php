<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Puncte extends Model
{
    protected $table="puncte";

    public function cont()
    {
        return $this->belongsTo('App\Conturi', 'conturi_id', 'id');
    }
}

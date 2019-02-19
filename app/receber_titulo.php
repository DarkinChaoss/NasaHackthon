<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receber_titulo extends Model
{
    public function cliente(){
    	   return $this->hasMany('App\cliente');
    }
}

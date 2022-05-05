<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';


    public function users() {
        return $this->belongsToMany('App\User');
    }
}

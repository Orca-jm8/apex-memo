<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $fillable = ['memo'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}

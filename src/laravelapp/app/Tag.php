<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];
    
    public function memos()
    {
        return $this->belongsToMany('App\Memo');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['title', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->select('id');
    }
    
    public function list()
    {
        return $this->hasMany('App\Lists')
        ->select('id', 'title', 'order')
        ->orderBy('order', 'desc');
    }

}

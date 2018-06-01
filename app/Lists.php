<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['order', 'board_id', 'title'];

    public function board()
    {
        return $this->belongsTo('App\Board')->select('id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Item', 'list_id')->select('id', 'description');
    }

}

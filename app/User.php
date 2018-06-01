<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owned_boards()
    {
        return $this->hasMany('App\Board')->select(['id', 'title', 'user_id']);
    }

    public function shared_boards()
    {
        return $this->belongsToMany('App\Board')->select(['boards.id', 'boards.title', 'boards.user_id']);
    }
}

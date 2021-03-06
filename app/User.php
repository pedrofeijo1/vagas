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

    public function favoritos()
    {
        return $this->hasMany('App\Favoritos', 'id_usuario', 'id');
    }

    public function vagas()
    {
        return $this->belongsToMany('App\Vagas', 'favoritos', 'id_usuario', 'id_vaga');
    }
}

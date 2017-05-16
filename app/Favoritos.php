<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    protected $table = 'favoritos';
    public $timestamps = false;

    public function vaga()
    {
        return $this->belongsTo('App\Vagas', 'id', 'id_vaga');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'id', 'id_usuario');
    }

    public static function getPorUsuarioEVagas($usuario, $vaga)
    {
        return self::where('id_usuario', '=', $usuario)->where('id_vaga', '=', $vaga);
    }

    public static function usuarioTemVagaComoFavorito($usuario, $vaga)
    {
        return self::getPorUsuarioEVagas($usuario, $vaga)->exists();
    }

    public static function deleteIfExists($usuario, $vaga)
    {
        if (self::usuarioTemVagaComoFavorito($usuario, $vaga)) {
            self::getPorUsuarioEVagas($usuario, $vaga)->delete();
        } else {
            $favorito = new self;
            $favorito->id_usuario = $usuario;
            $favorito->id_vaga= $vaga;
            $favorito->save();
        }
    }
}

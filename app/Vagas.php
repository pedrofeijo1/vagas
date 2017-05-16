<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    protected $table = 'vagas';
    public $timestamps = false;

    public function favoritos()
    {
        return $this->hasMany('App\Favoritos', 'id_vaga', 'id');
    }

    public static function procurar($funcao, $localizacao, $orderBy)
    {
        $vagas = self::where(function($query) use ($funcao, $localizacao){
            if (!empty($funcao)) {
                $query->where('titulo', 'like', "%{$funcao}%");
            }
            if (!empty($localizacao)) {
                $query->where('localizacao', $localizacao);
            }
        });
        if ($orderBy == "su") {
            return $vagas->orderBy('salarioDe', 'DESC');
        } elseif ($orderBy == "sd") {
            return $vagas->where('salario', '!=', 'A combinar')->orderBy('salarioDe', 'ASC');
        }
        return $vagas;
    }
}

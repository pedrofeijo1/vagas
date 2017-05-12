<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    protected $table = 'vagas';
    public $timestamps = false;

    public static function procurar($funcao, $localizacao)
    {
        $vagas = self::where(function($query) use ($funcao, $localizacao){
            if (!empty($funcao)) {
                $query->where('titulo', 'like', "%{$funcao}%");
            }
            if (!empty($localizacao)) {
                $query->where('localizacao', $localizacao);
            }
        });
        return $vagas->orderBy('salarioDe', 'DESC')->paginate(15);
    }
}

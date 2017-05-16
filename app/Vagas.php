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

    public static function procurar($funcao, $localizacao, $orderBy, $salarioDe, $salarioAte)
    {
        $vagas = self::where(function($query) use ($funcao, $localizacao, $salarioDe, $salarioAte){
            if (!empty($funcao)) {
                $query->where('titulo', 'like', "%{$funcao}%");
            }
            if (!empty($localizacao)) {
                $query->where('localizacao', '=', $localizacao);
            }
            if (!empty($salarioDe)) {
                $query->where('salarioDe', '>=', $salarioDe);
            }
            if (!empty($salarioAte)) {
                $query->where(function ($query) use ($salarioAte) {
                    $query->where('salarioAte', '<=', $salarioAte);
                    $query->where('salarioDe', '<=', $salarioAte);
                });
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

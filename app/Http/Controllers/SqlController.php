<?php

namespace App\Http\Controllers;

use App\Vagas;

class SqlController extends Controller
{
    private $id;
    private $titulo;
    private $url;
    private $jornada;
    private $salario;
    private $salarioDe;
    private $salarioAte;
    private $tipo_contrato;
    private $localizacao;
    private $cidade;
    private $estado;
    private $nome_empresa;
    private $exigencias;
    private $descricao;

    public function index()
    {
        $lines = file('C:\inetpub\wwwroot\vagas\public\vagas.sql');
        foreach($lines as $line){
            $matches = $this->aplicarRegex($line);
            $this->setVariaveis($matches);
//            $this->insert();
        }
    }

    private function getRegex()
    {
        return '/\((?<id>(\d+))\,\s\'(?<titulo>(.*))\'\,\s\'(?<url>(.*))\',\s\'(?<jornada>(.*))\',\s\'(?<salario>(.*))\',\s\'(?<tipo_contrato>(.*))\',\s\'(?<localizacao>(.*))\',\s\'(?<nome_empresa>(.*))\',\s\'(?<exigencias>(.*))\',\s\'(?<descricao>(.*))\'\),/iUx';
    }

    private function aplicarRegex($string)
    {
        preg_match_all($this->getRegex(), $string, $matches, PREG_SET_ORDER, 0);
        return $matches[0];
    }

    private function setVariaveis($array)
    {
        $this->id = $array['id'];
        $this->titulo = $array['titulo'];
        $this->url = $array['url'];
        $this->jornada = $array['jornada'];
        $this->salario = $array['salario'];
        $this->salarioDe = $this->formatarPreco($this->setSalarioDe($array['salario']));
        $this->salarioAte = $this->formatarPreco($this->setSalarioAte($array['salario']));
        $this->tipo_contrato = $array['tipo_contrato'];
        $this->localizacao = $array['localizacao'];
        $this->cidade = $this->setCidade($array['localizacao']);
        $this->estado = $this->setEstado($array['localizacao']);
        $this->nome_empresa = $array['nome_empresa'];
        $this->exigencias = $array['exigencias'];
        $this->descricao = $array['descricao'];
    }

    private function insert()
    {
        $vaga = new Vagas();
        $vaga->id = $this->id;
        $vaga->titulo = $this->titulo;
        $vaga->url = $this->url;
        $vaga->jornada = $this->jornada;
        $vaga->salario = $this->salario;
        $vaga->salarioDe = $this->salarioDe;
        $vaga->salarioAte = $this->salarioAte;
        $vaga->tipo_contrato = $this->tipo_contrato;
        $vaga->localizacao = $this->localizacao;
        $vaga->cidade = $this->cidade;
        $vaga->estado = $this->estado;
        $vaga->nome_empresa = $this->nome_empresa;
        $vaga->exigencias = $this->exigencias;
        $vaga->descricao = $this->descricao;
        $vaga->save();
    }

    private function aplicarRegexSalario($salario)
    {
        preg_match_all('/(^R\$\s(?<de>(.*))\sa\sR\$\s(?<ate>(.*))\s|R\$\s(?<salario>(.*))\s|A combinar)/U',
            $salario, $matches, PREG_SET_ORDER, 0);
        return $matches[0];
    }

    private function aplicarRegexLocalizacao($localizacao)
    {
        preg_match_all('/((?<cidade>(.*))(,\s(?<estado>(\w{2})))|(?<localizacao>(.*\S)))$/U', $localizacao, $matches, PREG_SET_ORDER, 0);
        return $matches[0];
    }

    private function setSalarioDe($salario)
    {
        $salario = $this->aplicarRegexSalario($salario);
        return (
            isset($salario['salario']) ? $salario['salario'] : (
                isset($salario['de']) ? $salario['de'] : $salario[1]
            )
        );
    }

    private function setSalarioAte($salario)
    {
        $salario = $this->aplicarRegexSalario($salario);
        return (isset($salario['ate']) ? $salario['ate'] : 0);
    }

    private function setCidade($localizacao)
    {
        $localizacao = $this->aplicarRegexLocalizacao($localizacao);
        return (isset($localizacao['localizacao']) ? $localizacao['localizacao'] : $localizacao['cidade']);
    }

    private function setEstado($localizacao)
    {
        $localizacao = $this->aplicarRegexLocalizacao($localizacao);
        return (isset($localizacao['estado']) ? $localizacao['estado'] : "--");
    }

    private function formatarPreco($valor)
    {
        return ($valor == "A combinar" ? 0 : floatval(str_replace(['.', ','], ['', '.'], $valor)));
    }
}

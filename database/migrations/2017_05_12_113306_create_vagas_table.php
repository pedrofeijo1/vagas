<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 200)->default('NULL');
            $table->string('url', 255)->default('NULL');
            $table->string('jornada', 50)->default('NULL');
            $table->string('salario', 50)->default('NULL');
            $table->double('salarioDe', 50)->default(0);
            $table->double('salarioAte')->default(0);
            $table->string('tipo_contrato', 150)->default('NULL');
            $table->string('localizacao', 50)->default('NULL');
            $table->string('cidade', 50)->default('NULL');
            $table->char('estado', 2)->default('--');
            $table->string('nome_empresa', 50)->default('NULL');
            $table->string('exigencias', 600)->default('NULL');
            $table->string('descricao', 3000)->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonesTable extends Migration {

    /** Run the migrations.
     * @return void */
    public function up() {

        Schema::create('tipos_telefone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 20);
            $table->string('descricao', 300)->nullable();
            $table->boolean('podePossuirRamal')->default(0);
            $table->boolean('informaOperadora')->default(0);
            $table->timestamps();
        });

        Schema::create('operadoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 20);
            $table->string('codigo', 4)->nullable();

            $table->timestamps();
        });

        Schema::create('telefones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_telefone_id');
            $table->foreign('tipo_telefone_id')->references('id')->on('tipos_telefone');

            $table->unsignedBigInteger('operadora_id')->nullable();
            $table->foreign('operadora_id')->references('id')->on('operadoras');

            $table->string('ddd', 3)->nullable();
            $table->string('numero', 15);
            $table->string('ramal', 10)->nullable();
            $table->string('observacao', 300)->nullable();
            $table->boolean('excluido')->default(0);
            $table->timestamps();
        });
    }

    /** Reverse the migrations.
     * @return void */
    public function down() {

        Schema::dropIfExists('telefones');
        Schema::dropIfExists('tipos_telefone');
        Schema::dropIfExists('operadoras');
    }
}

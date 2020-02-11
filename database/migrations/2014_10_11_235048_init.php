<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration {

    /** Run the migrations.
     * @return void */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 50);
            $table->string('descricao', 300);
            $table->timestamps();
        });

        Schema::create('imagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 50);
            $table->string('descricao', 300)->nullable();
            $table->string('extensao', 5);
            $table->string('caminho', 500)->nullable();
            $table->integer('tamanho')->unsigned();
            $table->boolean('destaque')->default(0);
            $table->binary('bits');
            $table->timestamps();
        });

        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100);                        // Razão social para jurídicas
            $table->string('nomeSocial', 100)->nullable();      // Nome fantasia para jurídicas
            $table->boolean('utilizaNomeSocial')->default(0);   // True para usar o nome fantasia

            $table->unsignedBigInteger('genero_id')->nullable(); // Não se aplica à jurídica
            $table->foreign('genero_id')->references('id')->on('generos');

            $table->date('dataNascimento')->nullable();

            $table->unsignedBigInteger('empresa')->nullable();           // empregador
            $table->foreign('empresa')->references('id')->on('pessoas');

            $table->string('cargo', 100)->nullable();
            $table->boolean('juridica')->default(0);
            $table->string('cpf_cnpj', 20)->unique()->nullable();
            $table->string('rg_ie', 20)->nullable();

            $table->unsignedBigInteger('imagem_id')->nullable();           // foto do profile ou logotipo para jurídicas
            $table->foreign('imagem_id')->references('id')->on('imagens');

            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /** * Reverse the migrations.
     * @return void */
    public function down() {
        Schema::dropIfExists('pessoas');
        Schema::dropIfExists('imagens');
        Schema::dropIfExists('sexos');
    }
}

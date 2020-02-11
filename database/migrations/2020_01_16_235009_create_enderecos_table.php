<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration {

    /** Run the migrations.
     * @return void */
    public function up() {

        Schema::create('paises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 100);
            $table->string('sigla', 2)->nullable();
            $table->string('ddi', 7)->nullable();
            $table->string('iName', 100)->nullable();
            $table->string('geoNameId', 7)->nullable();

            $table->unsignedBigInteger('imagem_id')->nullable();    // imagem da bandeira
            $table->foreign('imagem_id')->references('id')->on('imagens');

            $table->timestamps();
        });

        Schema::create('regioes', function (Blueprint $table) { // Para estatística e gráficos
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pais_id');
            $table->foreign('pais_id')->references('id')->on('paises');

            $table->string('nome',100);
            $table->string('sigla', 2);
            $table->string('codigoIbge', 3)->nullable();
            $table->string('iName', 100)->nullable();    // geoNames.org não têm registros das regiões do Brasil
            $table->string('geoNameId', 7)->nullable();
            $table->timestamps();
        });

        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pais_id');
            $table->foreign('pais_id')->references('id')->on('paises');

            $table->unsignedBigInteger('regiao_id')->nullable();
            $table->foreign('regiao_id')->references('id')->on('regioes');

            $table->string('nome', 200);
            $table->string('sigla', 2);
            $table->string('codigoIbge', 3)->nullable();
            $table->string('iName', 100)->nullable();
            $table->string('geoNameId', 7)->nullable();
            $table->timestamps();
        });

        Schema::create('mesorregioes', function (Blueprint $table) { // Para estatística e gráficos
            $table->bigIncrements('id');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->string('nome', 200);
            $table->string('codigoIbge', 4)->nullable();
            $table->string('iName', 100)->nullable();
            $table->string('geoNameId', 7)->nullable();
            $table->timestamps();
        });

        Schema::create('cidades', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedBigInteger('mesorregiao_id')->nullable();
            $table->foreign('mesorregiao_id')->references('id')->on('mesorregioes');

            $table->string('nome', 200);
            $table->string('ddd', 3)->nullable();
            $table->string('codigoIbge', 7)->nullable();
            $table->string('iName', 100)->nullable();
            $table->string('geoNameId', 7)->nullable();
            $table->timestamps();
        });

        Schema::create('tipos_endereco', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 150);
            $table->string('descricao', 300)->nullable();
            $table->timestamps();
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_endereco_id')->default(1);
            $table->foreign('tipo_endereco_id')->references('id')->on('tipos_endereco');

            $table->unsignedBigInteger('cidade_id')->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');

            $table->string('logradouro', 200);
            $table->string('numero', 20)->nullable();
            $table->string('complemento', 200)->nullable();
            $table->string('bairro', 150)->nullable();
            $table->string('cep', 15)->nullable();
            $table->string('observacao', 300)->nullable();
            $table->timestamps();
        });
    }

    /** Reverse the migrations.
     * @return void */
    public function down() {
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('tipos_endereco');
        Schema::dropIfExists('cidades');
        Schema::dropIfExists('mesorregioes');
        Schema::dropIfExists('estados');
        Schema::dropIfExists('regioes');
        Schema::dropIfExists('paises');
    }
}

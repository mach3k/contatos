<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder {

    /** Run the database seeds.
     * @return void */
    public function run() {

        DB::table('estados')->insert([
            // Sul
            ['nome' => 'Santa Catarina', 'sigla' => 'SC', 'pais_id' => 1, 'regiao_id' => 1, 'codigoIbge' => '42', 'iName' => 'Santa Catarina', 'geoNameId' => '3450387'],
            ['nome' => 'Rio Grande do Sul', 'sigla' => 'RS', 'pais_id' => 1, 'regiao_id' => 1, 'codigoIbge' => '43', 'iName' => 'Rio Grande do Sul', 'geoNameId' => '3451133'],
            ['nome' => 'Paraná', 'sigla' => 'PR', 'pais_id' => 1, 'regiao_id' => 1, 'codigoIbge' => '41', 'iName' => 'Paraná', 'geoNameId' => '3455077'],
            // Sudeste
            ['nome' => 'Minas Gerais', 'sigla' => 'MG', 'pais_id' => 1, 'regiao_id' => 2, 'codigoIbge' => '31', 'iName' => 'Minas Gerais', 'geoNameId' => '3457153'],
            ['nome' => 'Espírito Santo', 'sigla' => 'ES', 'pais_id' => 1, 'regiao_id' => 2, 'codigoIbge' => '32', 'iName' => 'Espírito Santo', 'geoNameId' => '3463930'],
            ['nome' => 'Rio de Janeiro', 'sigla' => 'RJ', 'pais_id' => 1, 'regiao_id' => 2, 'codigoIbge' => '33', 'iName' => 'Rio de Janeiro', 'geoNameId' => '3451189'],
            ['nome' => 'São Paulo', 'sigla' => 'SP', 'pais_id' => 1, 'regiao_id' => 2, 'codigoIbge' => '35', 'iName' => 'São Paulo', 'geoNameId' => '3448433'],
            // Centro-Oeste
            ['nome' => 'Mato Grosso do Sul', 'sigla' => 'MS', 'pais_id' => 1, 'regiao_id' => 3, 'codigoIbge' => '50', 'iName' => 'Mato Grosso do Sul', 'geoNameId' => '3457415'],
            ['nome' => 'Mato Grosso', 'sigla' => 'MT', 'pais_id' => 1, 'regiao_id' => 3, 'codigoIbge' => '51', 'iName' => 'Mato Grosso', 'geoNameId' => '3457419'],
            ['nome' => 'Goiás', 'sigla' => 'GO', 'pais_id' => 1, 'regiao_id' => 3, 'codigoIbge' => '52', 'iName' => 'Goiás', 'geoNameId' => '3462372'],
            ['nome' => 'Distrito Federal', 'sigla' => 'DF', 'pais_id' => 1, 'regiao_id' => 3, 'codigoIbge' => '53', 'iName' => 'Federal District', 'geoNameId' => '3463504'],
            // Norte
            ['nome' => 'Rondônia', 'sigla' => 'RO', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '11', 'iName' => 'Rondônia', 'geoNameId' => '3924825'],
            ['nome' => 'Acre', 'sigla' => 'AC', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '12', 'iName' => 'Acre', 'geoNameId' => '3665474'],
            ['nome' => 'Amazonas', 'sigla' => 'AM', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '13', 'iName' => 'Amazonas', 'geoNameId' => '3665361'],
            ['nome' => 'Roraima', 'sigla' => 'RR', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '14', 'iName' => 'Roraima', 'geoNameId' => '3662560'],
            ['nome' => 'Pará', 'sigla' => 'PA', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '15', 'iName' => 'Pará', 'geoNameId' => '3393129'],
            ['nome' => 'Amapá', 'sigla' => 'AP', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '16', 'iName' => 'Amapá', 'geoNameId' => '3407762'],
            ['nome' => 'Tocantins', 'sigla' => 'TO', 'pais_id' => 1, 'regiao_id' => 4, 'codigoIbge' => '17', 'iName' => 'Tocantins', 'geoNameId' => '3474575'],
            // Nordeste
            ['nome' => 'Maranhão', 'sigla' => 'MA', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '21', 'iName' => 'Maranhão', 'geoNameId' => '3395443'],
            ['nome' => 'Piauí', 'sigla' => 'PI', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '22', 'iName' => 'Piauí', 'geoNameId' => '3392213'],
            ['nome' => 'Ceará', 'sigla' => 'CE', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '23', 'iName' => 'Ceará', 'geoNameId' => '3402362'],
            ['nome' => 'Rio Grande do Norte', 'sigla' => 'RN', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '24', 'iName' => 'Rio Grande do Norte', 'geoNameId' => '3390290'],
            ['nome' => 'Paraíba', 'sigla' => 'PB', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '25', 'iName' => 'Paraíba', 'geoNameId' => '3393098'],
            ['nome' => 'Pernambuco', 'sigla' => 'PE', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '26', 'iName' => 'Pernambuco', 'geoNameId' => '3392268'],
            ['nome' => 'Alagoas', 'sigla' => 'AL', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '27', 'iName' => 'Alagoas', 'geoNameId' => '3408096'],
            ['nome' => 'Sergipe', 'sigla' => 'SE', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '28', 'iName' => 'Sergipe', 'geoNameId' => '3447799'],
            ['nome' => 'Bahia', 'sigla' => 'BA', 'pais_id' => 1, 'regiao_id' => 5, 'codigoIbge' => '29', 'iName' => 'Bahia', 'geoNameId' => '3471168']
         ]);

         $this->command->info('Estados cadastrados com sucesso!');
    }
}

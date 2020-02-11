<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesorregioesTableSeeder extends Seeder {

    /** Run the database seeds.
     * @return void */
    public function run() {

        DB::table('mesorregioes')->insert([
            // Santa Catarina
            ['nome' => 'Oeste Catarinense', 'estado_id' => 1, 'codigoIbge' => '4201' ],
            ['nome' => 'Norte Catarinense', 'estado_id' => 1, 'codigoIbge' => '4202' ],
            ['nome' => 'Serrana', 'estado_id' => 1, 'codigoIbge' => '4203' ],
            ['nome' => 'Vale do Itajaí', 'estado_id' => 1, 'codigoIbge' => '4204' ],
            ['nome' => 'Grande Florianópolis', 'estado_id' => 1, 'codigoIbge' => '4205' ],
            ['nome' => 'Sul Catarinense', 'estado_id' => 1, 'codigoIbge' => '4206' ],
            // Rio Grande do Sul
            ['nome' => 'Noroeste Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4301' ],
            ['nome' => 'Nordeste Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4302' ],
            ['nome' => 'Centro Ocidental Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4303' ],
            ['nome' => 'Centro Oriental Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4304' ],
            ['nome' => 'Metropolitana de Porto Alegre', 'estado_id' => 2, 'codigoIbge' => '4305' ],
            ['nome' => 'Sudoeste Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4306' ],
            ['nome' => 'Sudeste Rio-grandense', 'estado_id' => 2, 'codigoIbge' => '4307' ],
            // Paraná
            ['nome' => 'Noroeste Paranaense', 'estado_id' => 3, 'codigoIbge' => '4101' ],
            ['nome' => 'Centro Ocidental Paranaense', 'estado_id' => 3, 'codigoIbge' => '4102' ],
            ['nome' => 'Norte Central Paranaense', 'estado_id' => 3, 'codigoIbge' => '4103' ],
            ['nome' => 'Norte Pioneiro Paranaense', 'estado_id' => 3, 'codigoIbge' => '4104' ],
            ['nome' => 'Centro Oriental Paranaense', 'estado_id' => 3, 'codigoIbge' => '4105' ],
            ['nome' => 'Oeste Paranaense', 'estado_id' => 3, 'codigoIbge' => '4106' ],
            ['nome' => 'Sudoeste Paranaense', 'estado_id' => 3, 'codigoIbge' => '4107' ],
            ['nome' => 'Centro-Sul Paranaense', 'estado_id' => 3, 'codigoIbge' => '4108' ],
            ['nome' => 'Sudeste Paranaense', 'estado_id' => 3, 'codigoIbge' => '4109' ],
            ['nome' => 'Metropolitana de Curitiba', 'estado_id' => 3, 'codigoIbge' => '4110' ],
            // Minas Gerais
            ['nome' => 'Noroeste de Minas', 'estado_id' => 4, 'codigoIbge' => '3101' ],
            ['nome' => 'Norte de Minas', 'estado_id' => 4, 'codigoIbge' => '3102' ],
            ['nome' => 'Jequitinhonha', 'estado_id' => 4, 'codigoIbge' => '3103' ],
            ['nome' => 'Vale do Mucuri', 'estado_id' => 4, 'codigoIbge' => '3104' ],
            ['nome' => 'Triângulo Mineiro/Alto Paranaíba', 'estado_id' => 4, 'codigoIbge' => '3105' ],
            ['nome' => 'Central Mineira', 'estado_id' => 4, 'codigoIbge' => '3106' ],
            ['nome' => 'Metropolitana de Belo Horizonte', 'estado_id' => 4, 'codigoIbge' => '3107' ],
            ['nome' => 'Vale do Rio Doce', 'estado_id' => 4, 'codigoIbge' => '3108' ],
            ['nome' => 'Oeste de Minas', 'estado_id' => 4, 'codigoIbge' => '3109' ],
            ['nome' => 'Sul/Sudoeste de Minas', 'estado_id' => 4, 'codigoIbge' => '3110' ],
            ['nome' => 'Campo das Vertentes', 'estado_id' => 4, 'codigoIbge' => '3111' ],
            ['nome' => 'Zona da Mata', 'estado_id' => 4, 'codigoIbge' => '3112' ],
            // Espírito Santo
            ['nome' => 'Noroeste Espírito-santense', 'estado_id' => 5, 'codigoIbge' => '3201' ],
            ['nome' => 'Litoral Norte Espírito-santense', 'estado_id' => 5, 'codigoIbge' => '3202' ],
            ['nome' => 'Central Espírito-santense', 'estado_id' => 5, 'codigoIbge' => '3203' ],
            ['nome' => 'Sul Espírito-santense', 'estado_id' => 5, 'codigoIbge' => '3204' ],
            // Rio de Janeiro
            ['nome' => 'Noroeste Fluminense', 'estado_id' => 6, 'codigoIbge' => '3301' ],
            ['nome' => 'Norte Fluminense', 'estado_id' => 6, 'codigoIbge' => '3302' ],
            ['nome' => 'Centro Fluminense', 'estado_id' => 6, 'codigoIbge' => '3303' ],
            ['nome' => 'Baixadas', 'estado_id' => 6, 'codigoIbge' => '3304' ],
            ['nome' => 'Sul Fluminense', 'estado_id' => 6, 'codigoIbge' => '3305' ],
            ['nome' => 'Metropolitana do Rio de Janeiro', 'estado_id' => 6, 'codigoIbge' => '3306' ],
            // São Paulo
            ['nome' => 'São José do Rio Preto', 'estado_id' => 7, 'codigoIbge' => '3501' ],
            ['nome' => 'Ribeirão Preto', 'estado_id' => 7, 'codigoIbge' => '3502' ],
            ['nome' => 'Araçatuba', 'estado_id' => 7, 'codigoIbge' => '3503' ],
            ['nome' => 'Bauru', 'estado_id' => 7, 'codigoIbge' => '3504' ],
            ['nome' => 'Araraquara', 'estado_id' => 7, 'codigoIbge' => '3505' ],
            ['nome' => 'Piracicaba', 'estado_id' => 7, 'codigoIbge' => '3506' ],
            ['nome' => 'Campinas', 'estado_id' => 7, 'codigoIbge' => '3507' ],
            ['nome' => 'Presidente Prudente', 'estado_id' => 7, 'codigoIbge' => '3508' ],
            ['nome' => 'Marília', 'estado_id' => 7, 'codigoIbge' => '3509' ],
            ['nome' => 'Assis', 'estado_id' => 7, 'codigoIbge' => '3510' ],
            ['nome' => 'Itapetininga', 'estado_id' => 7, 'codigoIbge' => '3511' ],
            ['nome' => 'Macro Metropolitana Paulista', 'estado_id' => 7, 'codigoIbge' => '3512' ],
            ['nome' => 'Vale do Paraíba Paulista', 'estado_id' => 7, 'codigoIbge' => '3513' ],
            ['nome' => 'Litoral Sul Paulista', 'estado_id' => 7, 'codigoIbge' => '3514' ],
            ['nome' => 'Metropolitana de São Paulo', 'estado_id' => 7, 'codigoIbge' => '3515' ],
            // Mato Grosso do Sul
            ['nome' => 'Pantanais Sul Mato-grossense', 'estado_id' => 8, 'codigoIbge' => '5001' ],
            ['nome' => 'Centro Norte de Mato Grosso do Sul', 'estado_id' => 8, 'codigoIbge' => '5002' ],
            ['nome' => 'Leste de Mato Grosso do Sul', 'estado_id' => 8, 'codigoIbge' => '5003' ],
            ['nome' => 'Sudoeste de Mato Grosso do Sul', 'estado_id' => 8, 'codigoIbge' => '5004' ],
            // Mato Grosso
            ['nome' => 'Norte Mato-grossense', 'estado_id' => 9, 'codigoIbge' => '5101' ],
            ['nome' => 'Nordeste Mato-grossense', 'estado_id' => 9, 'codigoIbge' => '5102' ],
            ['nome' => 'Sudoeste Mato-grossense', 'estado_id' => 9, 'codigoIbge' => '5103' ],
            ['nome' => 'Centro-Sul Mato-grossense', 'estado_id' => 9, 'codigoIbge' => '5104' ],
            ['nome' => 'Sudeste Mato-grossense', 'estado_id' => 9, 'codigoIbge' => '5105' ],
            // Goiás
            ['nome' => 'Noroeste Goiano', 'estado_id' => 10, 'codigoIbge' => '5201' ],
            ['nome' => 'Norte Goiano', 'estado_id' => 10, 'codigoIbge' => '5202' ],
            ['nome' => 'Centro Goiano', 'estado_id' => 10, 'codigoIbge' => '5203' ],
            ['nome' => 'Leste Goiano', 'estado_id' => 10, 'codigoIbge' => '5204' ],
            ['nome' => 'Sul Goiano', 'estado_id' => 10, 'codigoIbge' => '5205' ],
            // Distrito Federal
            ['nome' => 'Distrito Federal', 'estado_id' => 11, 'codigoIbge' => '5301' ],
            // Rondônia
            ['nome' => 'Madeira-Guaporé', 'estado_id' => 12, 'codigoIbge' => '1101' ],
            ['nome' => 'Leste Rondoniense', 'estado_id' => 12, 'codigoIbge' => '1102' ],
            // Acre
            ['nome' => 'Vale do Juruá', 'estado_id' => 13, 'codigoIbge' => '1201' ],
            ['nome' => 'Vale do Acre', 'estado_id' => 13, 'codigoIbge' => '1202' ],
            // Amazonas
            ['nome' => 'Norte Amazonense', 'estado_id' => 14, 'codigoIbge' => '1301' ],
            ['nome' => 'Sudoeste Amazonense', 'estado_id' => 14, 'codigoIbge' => '1302' ],
            ['nome' => 'Centro Amazonense', 'estado_id' => 14, 'codigoIbge' => '1303' ],
            ['nome' => 'Sul Amazonense', 'estado_id' => 14, 'codigoIbge' => '1304' ],
            // Roraima
            ['nome' => 'Norte de Roraima', 'estado_id' => 15, 'codigoIbge' => '1401' ],
            ['nome' => 'Sul de Roraima', 'estado_id' => 15, 'codigoIbge' => '1402' ],
            // Pará
            ['nome' => 'Baixo Amazonas', 'estado_id' => 16, 'codigoIbge' => '1501' ],
            ['nome' => 'Marajó', 'estado_id' => 16, 'codigoIbge' => '1502' ],
            ['nome' => 'Metropolitana de Belém', 'estado_id' => 16, 'codigoIbge' => '1503' ],
            ['nome' => 'Nordeste Paraense', 'estado_id' => 16, 'codigoIbge' => '1504' ],
            ['nome' => 'Sudoeste Paraense', 'estado_id' => 16, 'codigoIbge' => '1505' ],
            ['nome' => 'Sudeste Paraense', 'estado_id' => 16, 'codigoIbge' => '1506' ],
            // Amapá
            ['nome' => 'Norte do Amapá', 'estado_id' => 17, 'codigoIbge' => '1601' ],
            ['nome' => 'Sul do Amapá', 'estado_id' => 17, 'codigoIbge' => '1602' ],
            // Tocantins
            ['nome' => 'Ocidental do Tocantins', 'estado_id' => 18, 'codigoIbge' => '1701' ],
            ['nome' => 'Oriental do Tocantins', 'estado_id' => 18, 'codigoIbge' => '1702' ],
            // Maranhão
            ['nome' => 'Norte Maranhense', 'estado_id' => 19, 'codigoIbge' => '2101' ],
            ['nome' => 'Oeste Maranhense', 'estado_id' => 19, 'codigoIbge' => '2102' ],
            ['nome' => 'Centro Maranhense', 'estado_id' => 19, 'codigoIbge' => '2103' ],
            ['nome' => 'Leste Maranhense', 'estado_id' => 19, 'codigoIbge' => '2104' ],
            ['nome' => 'Sul Maranhense', 'estado_id' => 19, 'codigoIbge' => '2105' ],
            // Piauí
            ['nome' => 'Norte Piauiense', 'estado_id' => 20, 'codigoIbge' => '2201' ],
            ['nome' => 'Centro-Norte Piauiense', 'estado_id' => 20, 'codigoIbge' => '2202' ],
            ['nome' => 'Sudoeste Piauiense', 'estado_id' => 20, 'codigoIbge' => '2203' ],
            ['nome' => 'Sudeste Piauiense', 'estado_id' => 20, 'codigoIbge' => '2204' ],
            // Ceará
            ['nome' => 'Noroeste Cearense', 'estado_id' => 21, 'codigoIbge' => '2301' ],
            ['nome' => 'Norte Cearense', 'estado_id' => 21, 'codigoIbge' => '2302' ],
            ['nome' => 'Metropolitana de Fortaleza', 'estado_id' => 21, 'codigoIbge' => '2303' ],
            ['nome' => 'Sertões Cearenses', 'estado_id' => 21, 'codigoIbge' => '2304' ],
            ['nome' => 'Jaguaribe', 'estado_id' => 21, 'codigoIbge' => '2305' ],
            ['nome' => 'Centro-Sul Cearense', 'estado_id' => 21, 'codigoIbge' => '2306' ],
            ['nome' => 'Sul Cearense', 'estado_id' => 21, 'codigoIbge' => '2307' ],
            // Rio Grande do Norte
            ['nome' => 'Oeste Potiguar', 'estado_id' => 22, 'codigoIbge' => '2401' ],
            ['nome' => 'Central Potiguar', 'estado_id' => 22, 'codigoIbge' => '2402' ],
            ['nome' => 'Agreste Potiguar', 'estado_id' => 22, 'codigoIbge' => '2403' ],
            ['nome' => 'Leste Potiguar', 'estado_id' => 22, 'codigoIbge' => '2404' ],
            // Paraíba
            ['nome' => 'Sertão Paraibano', 'estado_id' => 23, 'codigoIbge' => '2501' ],
            ['nome' => 'Borborema', 'estado_id' => 23, 'codigoIbge' => '2502' ],
            ['nome' => 'Agreste Paraibano', 'estado_id' => 23, 'codigoIbge' => '2503' ],
            ['nome' => 'Mata Paraibana', 'estado_id' => 23, 'codigoIbge' => '2504' ],
            // Pernambuco
            ['nome' => 'Sertão Pernambucano', 'estado_id' => 24, 'codigoIbge' => '2601' ],
            ['nome' => 'São Francisco Pernambucano', 'estado_id' => 24, 'codigoIbge' => '2602' ],
            ['nome' => 'Agreste Pernambucano', 'estado_id' => 24, 'codigoIbge' => '2603' ],
            ['nome' => 'Mata Pernambucana', 'estado_id' => 24, 'codigoIbge' => '2604' ],
            ['nome' => 'Metropolitana de Recife', 'estado_id' => 24, 'codigoIbge' => '2605' ],
            // Alagoas
            ['nome' => 'Sertão Alagoano', 'estado_id' => 25, 'codigoIbge' => '2701' ],
            ['nome' => 'Agreste Alagoano', 'estado_id' => 25, 'codigoIbge' => '2702' ],
            ['nome' => 'Leste Alagoano', 'estado_id' => 25, 'codigoIbge' => '2703' ],
            // Sergipe
            ['nome' => 'Sertão Sergipano', 'estado_id' => 26, 'codigoIbge' => '2801' ],
            ['nome' => 'Agreste Sergipano', 'estado_id' => 26, 'codigoIbge' => '2802' ],
            ['nome' => 'Leste Sergipano', 'estado_id' => 26, 'codigoIbge' => '2803' ],
            // Bahia
            ['nome' => 'Extremo Oeste Baiano', 'estado_id' => 27, 'codigoIbge' => '2901' ],
            ['nome' => 'Vale São-Franciscano da Bahia', 'estado_id' => 27, 'codigoIbge' => '2902' ],
            ['nome' => 'Centro Norte Baiano', 'estado_id' => 27, 'codigoIbge' => '2903' ],
            ['nome' => 'Nordeste Baiano', 'estado_id' => 27, 'codigoIbge' => '2904' ],
            ['nome' => 'Metropolitana de Salvador', 'estado_id' => 27, 'codigoIbge' => '2905' ],
            ['nome' => 'Centro Sul Baiano', 'estado_id' => 27, 'codigoIbge' => '2906' ],
            ['nome' => 'Sul Baiano', 'estado_id' => 27, 'codigoIbge' => '2907' ]
         ]);

         $this->command->info('Mesorregioes cadastradas com sucesso!');
    }
}

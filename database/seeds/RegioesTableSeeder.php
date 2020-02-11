<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegioesTableSeeder extends Seeder {

    /** Run the database seeds.
     * @return void */
    public function run() {

        // GeoNames.org não têm registros das regiões do Brasil

        DB::table('regioes')->insert([
            ['pais_id' => 1, 'nome' => 'Sul', 'sigla' => 'S', 'codigoIbge' => '4'],
            ['pais_id' => 1, 'nome' => 'Sudeste', 'sigla' => 'SE', 'codigoIbge' => '3'],
            ['pais_id' => 1, 'nome' => 'Centro-Oeste', 'sigla' => 'CO', 'codigoIbge' => '5'],
            ['pais_id' => 1, 'nome' => 'Norte', 'sigla' => 'N', 'codigoIbge' => '1'],
            ['pais_id' => 1, 'nome' => 'Nordeste', 'sigla' => 'NE', 'codigoIbge' => '2']
         ]);

         $this->command->info('Regioes do Brasil cadastradas com sucesso!');
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTelefoneTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('tipos_telefone')->insert([
            ['nome' => 'Celular', 'informaOperadora' => true],
            ['nome' => 'Residencial', 'informaOperadora' => false],
            ['nome' => 'Comercial', 'informaOperadora' => false]
         ]);

         $this->command->info('Tipos de telefones cadastrados com sucesso!');

         DB::table('operadoras')->insert([
            ['nome' => 'Vivo', 'codigo' => '15'],
            ['nome' => 'Oi', 'codigo' => '31'],
            ['nome' => 'Claro', 'codigo' => '21'],
            ['nome' => 'Tim', 'codigo' => '41'],
            ['nome' => 'GVT', 'codigo' => '25'],
            ['nome' => 'Convergia', 'codigo' => '32'],
            ['nome' => 'Intelig23', 'codigo' => '23'],
            ['nome' => 'CTBC', 'codigo' => '21'],
            ['nome' => 'Sercomtel', 'codigo' => '43'],
            ['nome' => 'Aerotech', 'codigo' => '17'],
            ['nome' => 'NEXTEL', 'codigo' => '99']
          ]);

          $this->command->info('Operadoras de telefone cadastrados com sucesso!');
    }
}

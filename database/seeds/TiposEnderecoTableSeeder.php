<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEnderecoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('tipos_endereco')->insert([
            ['nome' => 'Residencial urbano'],
            ['nome' => 'Comercial'],
            ['nome' => 'Rural']
         ]);

         $this->command->info('Tipos de endereços cadastrados com sucesso!');
    }
}

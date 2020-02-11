<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('generos')->insert([
            ['nome' => 'Masculino', 'descricao' => 'Nasceu biológicamente masculino e se identifica como tal'],
            ['nome' => 'Feminino', 'descricao' => 'Nasceu biológicamente feminino e se identifica como tal'],
            ['nome' => 'Masculino trans', 'descricao' => 'Nasceu biológicamente masculino, mas se identifica como feminino'],
            ['nome' => 'Feminino trans', 'descricao' => 'Nasceu biológicamente feminino, mas se identifica como masculino'],
            ['nome' => 'Não-binário', 'descricao' => 'Mistura entre masculino e feminino, ou a total indiferença entre ambos']
         ]);

         $this->command->info('Gêneros cadastrados com sucesso!');
    }
}

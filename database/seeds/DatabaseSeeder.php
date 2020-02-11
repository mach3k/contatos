<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder  {

    /** * Seed the application's database.
     * @return void */
    public function run() {

        $this->call(PaisesTableSeeder::class);
        $this->call(RegioesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MesorregioesTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
        $this->call(TiposEnderecoTableSeeder::class);

        $this->call(GenerosTableSeeder::class);
        // $this->call(TiposEmailTableSeeder::class);
        $this->call(TiposTelefoneTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
    }
}

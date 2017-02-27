<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        // $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(TestUserTableSeeder::class);
        //this->call(LocalTableSeeder::class);
        $this->call(AboutTableSeeder::class);
        $this->call(BusinessTableSeeder::class);
        $this->call(PerfilUsuarioTableSeeder::class);
        $this->call(TestUsuarioTableSeeder::class);

        $this->call(TipoPescaSeeder::class);
        $this->call(CategoriaPuertoSeeder::class);
        $this->call(CapitaniaTableSeeder::class);
        $this->call(FabricaTableSeeder::class);
        $this->call(TerminalTableSeeder::class);
        $this->call(PuertoTableSeeder::class);
        $this->call(EspecieMarinaTableSeeder::class);
        $this->call(PermisoMarineroTableSeeder::class);
        $this->call(PermisoPatronTableSeeder::class);
        $this->call(PermisoPescaTableSeeder::class);
        $this->call(CertificadoMatriculaTableSeeder::class);
        $this->call(EmbarcacionTableSeeder::class);
        $this->call(EspecieMarinaTableSeeder::class);
        $this->call(PescadorTableSeeder::class);

        Model::reguard();
    }
}

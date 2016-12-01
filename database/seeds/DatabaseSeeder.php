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

        Model::reguard();
    }
}

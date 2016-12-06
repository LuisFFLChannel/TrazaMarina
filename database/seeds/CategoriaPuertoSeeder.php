<?php

use Illuminate\Database\Seeder;
use App\Models\CategoriaPuerto;
class CategoriaPuertoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoriaPuerto::insert([  'nombre' => 'Playa','descripcion' => 'Descripcion', 'activo' => 1]);
        CategoriaPuerto::insert([  'nombre' => 'Caleta','descripcion' => 'Descripcion', 'activo' => 1]);
        CategoriaPuerto::insert([  'nombre' => 'Muelle','descripcion' => 'Descripcion', 'activo' => 1]);
        CategoriaPuerto::insert([  'nombre' => 'DPA','descripcion' => 'Descripcion', 'activo' => 1]);
        CategoriaPuerto::insert([  'nombre' => 'Privados','descripcion' => 'Descripcion', 'activo' => 1]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\TipoPesca;
class TipoPescaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoPesca::insert([  'nombre' => 'Espinel','descripcion' => 'Descripcion', 'activo' => 1]);
        TipoPesca::insert([  'nombre' => 'Redes de Cortina','descripcion' => 'Descripcion', 'activo' => 1]);
        TipoPesca::insert([  'nombre' => 'Redes de Cerco','descripcion' => 'Descripcion', 'activo' => 1]);
        TipoPesca::insert([  'nombre' => 'A la punta','descripcion' => 'Descripcion', 'activo' => 1]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Fabrica;
class FabricaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Fabrica::insert([  'nombre' => 'Fabrica 1','direccion' => 'Jr. Ejemplo', 'coordenadaX' => -23.084684, 'coordenadaY'=>-11.13190,
                        'imagen' => 'images/fabrica.jpg', 'activo' => 1]);
        Fabrica::insert([  'nombre' => 'Fabrica 2','direccion'=> 'Calle Ejemplo', 'coordenadaX' => 19.054764, 'coordenadaY'=>-8.145789,
                        'imagen' => 'images/fabrica.jpg', 'activo' => 1]);
        Fabrica::insert([  'nombre' => 'Fabrica 3','direccion' => 'Av Ejemplo', 'coordenadaX' => -37.0567784, 'coordenadaY'=> 13.101180,
                        'imagen' => 'images/fabrica.jpg', 'activo' => 1]);
    }
}

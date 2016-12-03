<?php

use Illuminate\Database\Seeder;
use App\Models\Dpa;
class DpaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        //
        Dpa::insert([  'nombre' => 'Dpa 1','direccion' => 'Jr. Ejemplo', 'coordenadaX' => -3.084684, 'coordenadaY'=> 5.391390,
                        'imagen' => 'images/dpa.jpg', 'activo' => 1]);
        Dpa::insert([  'nombre' => 'Dpa 2','direccion' => 'Calle Ejemplo', 'coordenadaX' => 6.054764, 'coordenadaY'=> 3.145789,
                        'imagen' => 'images/dpa.jpg', 'activo' => 1]);
    }
    
}

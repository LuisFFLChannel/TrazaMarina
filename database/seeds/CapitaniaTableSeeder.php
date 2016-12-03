<?php

use Illuminate\Database\Seeder;
use App\Models\Capitania;
class CapitaniaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Capitania::insert([  'nombre' => 'Capitania 1','direccion' => 'Jr. Ejemplo', 'coordenadaX' => -23.23684, 'coordenadaY'=> 4.329390,
                        'imagen' => 'images/capitania.jpg', 'activo' => 1]);
        Capitania::insert([  'nombre' => 'Capitania 2','direccion' => 'Calle Ejemplo', 'coordenadaX' => 15.053464, 'coordenadaY'=> 13.14579,
                        'imagen' => 'images/capitania.jpg', 'activo' => 1]);
    }
}

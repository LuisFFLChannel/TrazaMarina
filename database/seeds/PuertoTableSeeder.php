<?php

use Illuminate\Database\Seeder;
use App\Models\Puerto;
class PuertoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Puerto::insert([  'nombre' => 'Paita','direccion' => 'Jr. Ferrocarril 127 Paita, Paita', 'coordenadaX' => -5.085784, 'coordenadaY'=>-81.108180,
                        'imagen' => 'images/puerto.jpg', 'activo' => 1]);
        Puerto::insert([  'nombre' => 'Paita','direccion' => 'Manco Capac 255, Callao', 'coordenadaX' => -12.054767, 'coordenadaY'=>-77.149829,
                        'imagen' => 'images/puerto.jpg', 'activo' => 1]);
        Puerto::insert([  'nombre' => 'Puerto 1','direccion' => 'Av Ejemplo', 'coordenadaX' => -7.085784, 'coordenadaY'=>-73.108180,
                        'imagen' => 'images/puerto.jpg', 'activo' => 1]);
    }
}

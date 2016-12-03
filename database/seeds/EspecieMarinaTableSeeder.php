<?php

use Illuminate\Database\Seeder;
use App\Models\EspecieMarina;
use Carbon\Carbon;
class EspecieMarinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        EspecieMarina::insert([  'nombre' => 'Perico','nombreCientifico' => 'Coryphaena hippurus', 'promedioVida' => 10, 'tamanoMin'=> 0.70,'tamanoMax'=> 15.20,
                        'inicioVeda'=>Carbon::create(1990,5,1)->toDateString(), 'finVeda'=>Carbon::create(1990,9,30)->toDateString(),
                        'pescaPromedio'=> 300,'tamanoMax'=> 2,
                        'imagen' => 'images/perico.jpg', 'activo' => 1]);

        EspecieMarina::insert([  'nombre' => 'Corvina','nombreCientifico' => 'Argyrosomus regius', 'promedioVida' => 12, 'tamanoMin'=> 0.55,'tamanoMax'=> 7.45,
                        'inicioVeda'=>Carbon::create(1990,10,1)->toDateString(), 'finVeda'=>Carbon::create(1990,11,30)->toDateString(),
                        'pescaPromedio'=> 500,'factorHielo'=> 2.3,
                        'imagen' => 'images/corvina.jpg', 'activo' => 1]);

        EspecieMarina::insert([  'nombre' => 'Tollo','nombreCientifico' => 'Mustelus Whitmeyl', 'promedioVida' => 8.5, 'tamanoMin'=> 0.6,'tamanoMax'=> 12.4,
                        'inicioVeda'=>Carbon::create(1990,7,1)->toDateString(), 'finVeda'=>Carbon::create(1990,6,30)->toDateString(),
                        'pescaPromedio'=> 210,'factorHielo'=> 1.75,
                        'imagen' => 'images/tollo.jpg', 'activo' => 1]);



    }
}

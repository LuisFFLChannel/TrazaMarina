<?php

use Illuminate\Database\Seeder;
use App\Models\PermisoMarinero;
use Carbon\Carbon;
class PermisoMarineroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PermisoMarinero::insert([  'nombres' => 'Juan Benito','apellidos' => 'Jimenez Feberez', 'dni' => 34221145, 
                        'numeroMarinero' => 'MFSD34221145', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Jorge Raul','apellidos' => 'Negrete Yturve', 'dni' => 55521145, 
                        'numeroMarinero' => 'WESD55521145', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Ivan Toribio','apellidos' => 'Kahrl Reboneta', 'dni' => 89201455, 
                        'numeroMarinero' => 'TTRE89201455', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Hugo','apellidos' => 'Fernandez Vigil', 'dni' => 44673245, 
                        'numeroMarinero' => 'FDWE44673245', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Julian Fabricio','apellidos' => 'Berniz Dominguez', 'dni' => 52002145, 
                        'numeroMarinero' => 'RFDA52002145', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Nando Fernando','apellidos' => 'Portugal Nima', 'dni' => 87331214, 
                        'numeroMarinero' => 'SSDQ87331214', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoMarinero::insert([  'nombres' => 'Percy','apellidos' => 'Collantes Perez', 'dni' => 65233123, 
                        'numeroMarinero' => 'BDWW65233123', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 0, 'activo' => 1]);
    }

}

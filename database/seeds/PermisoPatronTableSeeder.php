<?php

use Illuminate\Database\Seeder;
use App\Models\PermisoPatron;
use Carbon\Carbon;
class PermisoPatronTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PermisoPatron::insert([  'nombres' => 'Juan Benito','apellidos' => 'Jimenez Feberez', 'dni' => 34221145, 
                        'numeroPatron' => 'MFSD34221145', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Jorge Raul','apellidos' => 'Negrete Yturve', 'dni' => 55521145, 
                        'numeroPatron' => '55521145RRDDAS', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Ivan Toribio','apellidos' => 'Kahrl Reboneta', 'dni' => 89201455, 
                        'numeroPatron' => '89201455TREFFS', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 1, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Hugo','apellidos' => 'Fernandez Vigil', 'dni' => 44673245, 
                        'numeroPatron' => '44673245HGDSSE', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 0, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Julian Fabricio','apellidos' => 'Berniz Dominguez', 'dni' => 52002145, 
                        'numeroPatron' => '52002145MMADAF', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 0, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Nando Fernando','apellidos' => 'Portugal Nima', 'dni' => 87331214, 
                        'numeroPatron' => '87331214NBFFAD', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 0, 'activo' => 1]);
        PermisoPatron::insert([  'nombres' => 'Percy','apellidos' => 'Collantes Perez', 'dni' => 65233123, 
                        'numeroPatron' => '65233123CCDERT', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 
                        'asignado' => 0, 'activo' => 1]);
    }
}

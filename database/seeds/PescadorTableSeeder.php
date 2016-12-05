<?php

use Illuminate\Database\Seeder;
use App\Models\Pescador;
use Carbon\Carbon;
class PescadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pescador::insert([  'nombres' => 'Juan Benito','apellidos' => 'Jimenez Feberez', 'dni' => 34221145, 
                        'telefono' => '998800212', 'correo' => 'juanbenito@gmail.com',
                        'cumpleanos'=>Carbon::create(1990,8,1)->toDateString(), 
                        'permiso_marinero_id' => 1, 'permiso_patron_id' => 1, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Jorge Raul','apellidos' => 'Negrete Yturve', 'dni' => 55521145, 
                        'telefono' => '956702024', 'correo' => 'jorgeraul@gmail.com',
                        'cumpleanos'=>Carbon::create(1975,5,5)->toDateString(), 
                        'permiso_marinero_id' => 2, 'permiso_patron_id' => 2, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Ivan Toribio','apellidos' => 'Kahrl Reboneta', 'dni' => 89201455, 
                        'telefono' => '998579974', 'correo' => 'ivantoribio@gmail.com',
                        'cumpleanos'=>Carbon::create(1995,9,14)->toDateString(), 
                        'permiso_marinero_id' => 3, 'permiso_patron_id' => 3, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Hugo','apellidos' => 'Fernandez Vigil', 'dni' => 44673245, 
                        'telefono' => '934002125', 'correo' => 'hugo@gmail.com',
                        'cumpleanos'=>Carbon::create(1990,6,21)->toDateString(), 
                        'permiso_marinero_id' => 4, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Julian Fabricio','apellidos' => 'Berniz Dominguez', 'dni' => 52002145, 
                        'telefono' => '955425684', 'correo' => 'julianfabricio@gmail.com',
                        'cumpleanos'=>Carbon::create(1993,11,4)->toDateString(), 
                        'permiso_marinero_id' => 5, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Nando Fernando','apellidos' => 'Portugal Nima', 'dni' => 87331214, 
                        'telefono' => '995542322', 'correo' => 'nandofernando@gmail.com',
                        'cumpleanos'=>Carbon::create(1992,5,6)->toDateString(), 
                        'permiso_marinero_id' => 6, 'activo' => 1]);
        Pescador::insert([  'nombres' => 'Percy','apellidos' => 'Collantes Perez', 'dni' => 65233123, 
                        'telefono' => '967773332', 'correo' => 'percy@gmail.com',
                        'cumpleanos'=>Carbon::create(1980,5,18)->toDateString(), 
                         'activo' => 1]);
    }

}

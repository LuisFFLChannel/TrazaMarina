<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use Carbon\Carbon;

class TestUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::insert([  'nombres' => 'Cliente1','apellidos' => 'ApellidoC', 'dni' => '24578557', 'direccion'=>'Av. Cliente 123',
                        'correo' => 'cliente1@mail.com', 'telefono' => '944133643', 'cumpleanos'=>Carbon::create(1990,1,8)->toDateString(), 
                        'tipoUsuario_id'=>1, 'usuario' => 'cliente1', 'contrasena' => bcrypt('cliente')]);

        Usuario::insert([  'nombres' => 'Extraccion1','apellidos' => 'ApellidoE', 'dni' => '24368557', 'direccion'=>'Av. Extraccion 123',
                        'correo' => 'extraccion1@mail.com', 'telefono' => '944432643', 'cumpleanos'=>Carbon::create(1990,1,7)->toDateString(), 
                        'tipoUsuario_id'=>2, 'usuario' => 'extraccion1', 'contrasena' => bcrypt('extraccion')]);

        Usuario::insert([  'nombres' => 'Intermediario1','apellidos' => 'ApellidoI', 'dni' => '67578557', 'direccion'=>'Av. Intermediario 123',
                        'correo' => 'intermediario1@mail.com', 'telefono' => '943112343', 'cumpleanos'=>Carbon::create(1990,1,6)->toDateString(), 
                        'tipoUsuario_id'=>3, 'usuario' => 'intermediario1', 'contrasena' => bcrypt('intermediario')]);

        Usuario::insert([  'nombres' => 'Admin1','apellidos' => 'ApellidoA', 'dni' => '89578557', 'direccion'=>'Av. Admin 123',
                        'correo' => 'admin1@mail.com', 'telefono' => '956133643', 'cumpleanos'=>Carbon::create(1990,1,4)->toDateString(), 
                        'tipoUsuario_id'=>4, 'usuario' => 'admin1', 'contrasena' => bcrypt('admin')]);

        Usuario::insert([  'nombres' => 'Validador1','apellidos' => 'ApellidoV', 'dni' => '75578117', 'direccion'=>'Av. Validador 123',
                        'correo' => 'validador1@mail.com', 'telefono' => '956013643', 'cumpleanos'=>Carbon::create(1990,9,2)->toDateString(), 
                        'tipoUsuario_id'=>5, 'usuario' => 'validador1', 'contrasena' => bcrypt('validador')]);

    }
}

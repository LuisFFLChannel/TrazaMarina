<?php

use Illuminate\Database\Seeder;
use App\Perfil;
class PerfilUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::insert(['nombre' => 'Cliente','descripcion'=>'CLIENT', 'activo'=>1]);
        Perfil::insert(['nombre' => 'Extraccion','descripcion'=>'EXTRACCION','activo'=>1]);
        Perfil::insert(['nombre' => 'Intermediario','descripcion'=>'INTERMEDIARIO','activo'=>1]);
        Perfil::insert(['nombre' => 'Admininstrador','descripcion'=>'ADMIN','activo'=>1]);
    }
}

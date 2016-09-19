<?php

use Illuminate\Database\Seeder;
use App\Perfil;
class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::insert(['nombres' => 'Cliente','descripcion'=>'CLIENT', 'activo'=>1]);
        Perfil::insert(['nombres' => 'Extraccion','descripcion'=>'EXTRACCION','activo'=>1]);
        Perfil::insert(['nombres' => 'Intermediario','descripcion'=>'INTERMEDIARIO','activo'=>1]);
        Perfil::insert(['nombres' => 'Admininstrador','descripcion'=>'ADMIN','activo'=>1]);
    }
}

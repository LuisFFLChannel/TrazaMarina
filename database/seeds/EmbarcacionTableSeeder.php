<?php

use Illuminate\Database\Seeder;
use App\Models\Embarcacion;
use Carbon\Carbon;
class EmbarcacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Embarcacion::insert([  'nombre' => 'Embarcacion 1', 'nMatricula' => 'MATR345FSS', 'nombreDueno' => 'Juan','apellidoDueno' => 'Perez',
        	'capacidad'=>50,'estara'=>15.2,'manga'=>7.6, 'puntual' =>5.2, 'certificado_matricula_id'=> 1, 'permiso_pesca_id'=>1,
        	'imagen'=>'images/embarcacion.jpg', 'activo' => 1]);
        Embarcacion::insert([  'nombre' => 'Embarcacion 2', 'nMatricula' => 'MR34YT5FS2', 'nombreDueno' => 'Leoncio','apellidoDueno' => 'Gomez',
        	'capacidad'=>50,'estara'=>5.2,'manga'=>9.6, 'puntual' =>5.7, 'certificado_matricula_id'=> 2, 'permiso_pesca_id'=>2,
        	'imagen'=>'images/embarcacion.jpg', 'activo' => 1]);
        Embarcacion::insert([  'nombre' => 'Embarcacion 3', 'nMatricula' => 'NDFFATEDS8', 'nombreDueno' => 'Kimberly','apellidoDueno' => 'Perez',
        	'capacidad'=>60,'estara'=>8.2,'manga'=>12.6, 'puntual' =>7.2, 'certificado_matricula_id'=> 3, 'permiso_pesca_id'=>3,
        	'imagen'=>'images/embarcacion.jpg', 'activo' => 1]);
        Embarcacion::insert([  'nombre' => 'Embarcacion 4', 'nMatricula' => 'RF562FS345', 'nombreDueno' => 'Juana','apellidoDueno' => 'Perez',
        	'capacidad'=>70,'estara'=>15.2,'manga'=>7.6, 'puntual' =>4.2, 
        	'imagen'=>'images/embarcacion.jpg', 'activo' => 1]);
        Embarcacion::insert([  'nombre' => 'Embarcacion 5', 'nMatricula' => 'MDR3434DD3', 'nombreDueno' => 'Rodolfo','apellidoDueno' => 'Jimenez',
        	'capacidad'=>55,'estara'=>24.2,'manga'=>10.6, 'puntual' =>5.2, 
        	'imagen'=>'images/embarcacion.jpg', 'activo' => 1]);

    }

}

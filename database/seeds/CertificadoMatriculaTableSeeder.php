<?php

use Illuminate\Database\Seeder;
use App\Models\CertificadoMatricula;
use Carbon\Carbon;
class CertificadoMatriculaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CertificadoMatricula::insert([  'nombreDueno' => 'Juan','apellidosDueno' => 'Perez', 'dniDueno' => 26345218, 
                        'nMatricula' => 'MATR345FSS', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'nombreDueno' => 'Leon','apellidosDueno' => 'Gomez', 'dniDueno' => 16343267, 
                        'nMatricula' => 'MR34YT5FS2', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'nombreDueno' => 'Kimberly','apellidosDueno' => 'Perez', 'dniDueno' => 12344528, 
                        'nMatricula' => 'NDFFATEDS8', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'nombreDueno' => 'Juana','apellidosDueno' => 'Perez', 'dniDueno' => 20326421, 
                        'nMatricula' => 'RF562FS345', 'asignado' => 0, 'activo' => 1]);
        CertificadoMatricula::insert([  'nombreDueno' => 'Rodolfo','apellidosDueno' => 'Jimenez', 'dniDueno' => 66344648, 
                        'nMatricula' => 'MDR3434DD3', 'asignado' => 0, 'activo' => 1]);
        
    }
}
        
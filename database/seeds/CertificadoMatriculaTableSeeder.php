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
        CertificadoMatricula::insert([  'codigo' => 'DI-07010862-11-002', 'libro'=>'1105', 'folio'=>'0213',
                        'nombreDueno' => 'Juan','apellidosDueno' => 'Perez', 'dniDueno' => 26345218, 'nombreEmbarcacion'=> 'Embarcacion 1',
                        'nMatricula' => 'MATR345FSS', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'codigo' => 'DI-07010863-11-002', 'libro'=>'1105', 'folio'=>'0213',
                        'nombreDueno' => 'Leon','apellidosDueno' => 'Gomez', 'dniDueno' => 16343267, 'nombreEmbarcacion'=> 'Embarcacion 2',
                        'nMatricula' => 'MR34YT5FS2', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'codigo' => 'DI-07010864-11-002', 'libro'=>'1105', 'folio'=>'0213',
                        'nombreDueno' => 'Kimberly','apellidosDueno' => 'Perez', 'dniDueno' => 12344528, 'nombreEmbarcacion'=> 'Embarcacion 3',
                        'nMatricula' => 'NDFFATEDS8', 'asignado' => 1, 'activo' => 1]);
        CertificadoMatricula::insert([  'codigo' => 'DI-07010865-11-002', 'libro'=>'1105', 'folio'=>'0213',
                        'nombreDueno' => 'Juana','apellidosDueno' => 'Perez', 'dniDueno' => 20326421, 'nombreEmbarcacion'=> 'Embarcacion 4',
                        'nMatricula' => 'RF562FS345', 'asignado' => 0, 'activo' => 1]);
        CertificadoMatricula::insert([  'codigo' => 'DI-07010866-11-002', 'libro'=>'1105', 'folio'=>'0213',
                        'nombreDueno' => 'Rodolfo','apellidosDueno' => 'Jimenez', 'dniDueno' => 66344648, 'nombreEmbarcacion'=> 'Embarcacion 5',
                        'nMatricula' => 'MDR3434DD3', 'asignado' => 0, 'activo' => 1]);
        
    }
}
        
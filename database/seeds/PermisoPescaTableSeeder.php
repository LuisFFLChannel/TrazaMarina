<?php

use Illuminate\Database\Seeder;
use App\Models\PermisoPesca;
use Carbon\Carbon;
class PermisoPescaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PermisoPesca::insert([  'nombre' => 'Permiso Pesca Nro 1', 
                        'nMatricula' => 'MATR345FSS', 'fechaVigencia'=>Carbon::create(2019,5,1)->toDateString(), 'asignado' => 1, 'activo' => 1]);
        PermisoPesca::insert([  'nombre' => 'Permiso Pesca Nro 2', 
                        'nMatricula' => 'MR34YT5FS2', 'fechaVigencia'=>Carbon::create(2018,5,1)->toDateString(), 'asignado' => 1, 'activo' => 1]);
        PermisoPesca::insert([  'nombre' => 'Permiso Pesca Nro 3',
                        'nMatricula' => 'NDFFATEDS8', 'fechaVigencia'=>Carbon::create(2016,5,1)->toDateString(), 'asignado' => 1, 'activo' => 1]);
        PermisoPesca::insert([  'nombre' => 'Permiso Pesca Nro 4',
                        'nMatricula' => 'RF562FS345', 'fechaVigencia'=>Carbon::create(2020,5,1)->toDateString(), 'asignado' => 0, 'activo' => 1]);
        PermisoPesca::insert([  'nombre' => 'Permiso Pesca Nro 5',
                        'nMatricula' => 'MDR3434DD3', 'fechaVigencia'=>Carbon::create(2020,5,1)->toDateString(), 'asignado' => 0, 'activo' => 1]);
    }

}

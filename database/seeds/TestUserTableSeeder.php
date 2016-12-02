<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class TestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([  'name' => 'Cliente','lastname' => 'ApellidoC', 'di_type'=> config('constants.national'), 'di' => '46898966', 'address'=>'Av. Cliente #532 San Borja',
                        'email' => 'cliente@mail.com', 'phone' => '944133643', 'points'=>0, 'birthday'=>Carbon::create(1991,1,8)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>1, 'password' => bcrypt('cliente')]);

        User::insert([  'name' => 'Admin','lastname' => 'ApellidoA', 'di_type'=> config('constants.international'), 'di' => '64222267', 'address'=>'Av. Admin #532 San Borja',
                        'email' => 'admin@mail.com', 'phone' => '944133643', 'birthday'=>Carbon::create(1994,1,24)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>4, 'password' => bcrypt('admin')]);
    
       
       User::insert([  'name' => 'UserPesca','lastname' => 'ApellidoPes', 'di_type'=> config('constants.national'), 'di' => '23455677', 'address'=>'Av. Ejemplo',
                        'email' => 'pesca@mail.com', 'phone' => '977139700', 'birthday'=>Carbon::create(1990,9,14)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>5, 'password' => bcrypt('pesca')]);
       
        User::insert([  'name' => 'UserInter','lastname' => 'ApellidoInt', 'di_type'=> config('constants.national'), 'di' => '34627543', 'address'=>'Av. Ejemplo',
                        'email' => 'intermediario@mail.com', 'phone' => '977139700', 'birthday'=>Carbon::create(1990,2,14)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>6, 'password' => bcrypt('intermediario')]);
        User::insert([  'name' => 'UserValida','lastname' => 'ApellidoVal', 'di_type'=> config('constants.national'), 'di' => '12453899', 'address'=>'Av. Ejemplo',
                        'email' => 'validor@mail.com', 'phone' => '977133700', 'birthday'=>Carbon::create(1990,2,14)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>7, 'password' => bcrypt('validor')]);


    }
}

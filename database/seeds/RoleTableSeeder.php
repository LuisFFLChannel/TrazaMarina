<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        Role::insert(['description'=>'CLIENT']);
        Role::insert(['description'=>'CLIENT2']);
        Role::insert(['description'=>'CLIENT3']);
        Role::insert(['description'=>'ADMIN']);
        Role::insert(['description'=>'USERPESCA']);
        Role::insert(['description'=>'USERINTERMEDIARIO']);
        Role::insert(['description'=>'USERVALIDADOR']);
    }
}

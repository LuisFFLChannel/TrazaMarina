<?php

use Illuminate\Database\Seeder;
use App\Models\Business;
class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::insert([
            'business_name'	=>	'WWF - Trazabilidad',
            'ruc'			=>	12345678912,
            'address'		=>	'Av. Trinidad Morán 853 Lima 14 - Perú',
            'reserve_time'  =>  24,
            'logo'			=>	'images/logo.jpg',
            'favicon'		=>	'images/wwfico.jpg',
        ]);
    }
}

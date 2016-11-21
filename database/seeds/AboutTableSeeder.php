<?php

use Illuminate\Database\Seeder;
use App\Models\About;
class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::insert([
            'description'=>'Descripcion de la empresa',
            'mision'=>'Mision de la empresa',
            'vision'=>'Vision de la empresa',
            'history'=>'Historia breve de la empresa',
            'youtube_url'=>'https://www.youtube.com/embed/eWlMfjuVqjk',
            'image'=>'images/logo.jpg',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Terminal;
class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Terminal::insert([  'nombre' => 'Terminal 1','direccion' => 'Jr. Ejemplo', 'coordenadaX' => -15.084684, 'coordenadaY'=>41.13190,
                        'imagen' => 'images/terminal.jpg', 'activo' => 1]);
        Terminal::insert([  'nombre' => 'Terminal 2','direccion' => 'Calle Ejemplo', 'coordenadaX' => 9.054764, 'coordenadaY'=>-7.145789,
                        'imagen' => 'images/terminal.jpg', 'activo' => 1]);
        Terminal::insert([  'nombre' => 'Terminal 3','direccion' => 'Av Ejemplo', 'coordenadaX' => -7.0567784, 'coordenadaY'=>-63.101180,
                        'imagen' => 'images/terminal.jpg', 'activo' => 1]);
    }
}

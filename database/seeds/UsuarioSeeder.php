<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tdatosexamen')->insert([
        	'cedula' => '0605043157',
            'foto' => 'default.png',
            'nombre' => 'JENNY ALARCON',
        	  'password' => bcrypt('0605043157'),
            'codpersona' => '134',
            'email' => 'XYZ@gmail.com',
            'descripcion' => 'Soy la Estu',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dd(ProfessionSeeder::class);

    	$this->truncateTables([
    		'users',
			'professions'
    	]);
    	


        // $this->call(UsersTableSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
    	//Desactiva la revision de llave foranea en la base de datos antes de vaciar la tabla.
    	
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');


    	foreach ($tables as $table) {
			
    		//elimina toda las professions de la base de datos---de la tabla professions antes de crearlas nuevamente.    		

    		DB::table($table)->truncate();	
    	}
    	

    	//activa la revision de llave foranea.
    	DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}

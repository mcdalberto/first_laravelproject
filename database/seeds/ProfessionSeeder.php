<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // DB::table('professions')->insert([
        // 	'title'=> 'desarrollador back-end',
        // ]);

    	Profession::create([
        	'title'=> 'desarrollador back-end',
        ]);


     	Profession::create([
        	'title'=> 'desarrollador frond-end',
        ]);


     	Profession::create([
        	'title'=> 'Diseñador web',
        ]);

        factory(Profession::class,10)->create();
        // DB::table('professions')->insert([
        // 	'title'=> 'Diseñador web',
        // ]);

        // DB::table('professions')->insert([
        // 	'title'=> 'Diseñador web',
        // ]);
    }
}

<?php


use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //se utiliza =? por seguridad cuando un usuario esta ingresando datos desde la apliacion.
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?',['desarrollador back-end']);

       
        
    	// $professions = DB::table('professions')->select('id')->take(1)->get();
    	
    	// $profession = DB::table('professions')
    	// 	->select('id','title')
    	// 	->where('title','=','desarrollador back-end')
    	// 	->first();

		
    	/*$professionId = DB::table('professions')
    	
    		->where('title','desarrollador back-end')
    		->value('id');  */  		
    	
    	


    	$professionId = Profession::where('title','desarrollador back-end')
    		->value('id');

    	//dd($professionId);
    	

    	factory(User::class)->create([

    		'profession_id' => $professionId,

        	'name'=>'Daniel Mendez',
        	
        	'email'=>'daniel@gmail.com',
        	
        	'password'=>bcrypt('laravel'),
        	
        	'is_admin'=>true,
        ]);
        	

        //factory crea usuarios aleatoriamente o especificando algunos parametros con valores especificos
        

        factory(User::class)->create([
        	'profession_id' =>$professionId,
        ]);

        
        factory(User::class,48)->create();
        
        

       	//dd(User::get());
        //dd(Carbon::now());

        // DB::table('users')->insert([

        // 	'name'=>'daniel alberto',
        	
        // 	'email'=>'daniel@gmail.com',
        	
        // 	'password'=>bcrypt('laravel'),
        // 	'profession_id' => $professionId,

        // ]);
    }
}

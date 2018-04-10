<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Testing\RefreshDatabase;



class UserModuleTest extends TestCase
{


    use RefreshDatabase;


    /** @test */
    function it_displas_a_404_error_if_user_not_found()
        {
            $this->get('usuarios/999')
            ->assertStatus(404)
            ->assertSee('Pagina no encontrada.');
        }    

    /** @test */
    function it_show_the_users_list()
    {
        
        factory(User::class)->create([
            'name' => 'genesis',
            
        ]);
        factory(User::class)->create([
            'name' => 'Daniel Alberto',

        ]);

        $this->get ('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Daniel Alberto')
            ->assertSee('genesis');

    }

    /** @test */
    function it_show_a_default_message_if_the_users_list_is_empty()
    {
        
       //DB::table('users')->truncate();

        $this->get ('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');


    }
    /** @test */
    function it_displays_the_users_details()
    {
        
        $user = factory(User::class)->create([
            'name' => 'Daniel Mendez',

        ]);
        $this->get('/usuarios/'.$user->id)//usuario/5
            ->assertStatus(200)
            ->assertSee('Daniel Mendez');

           // ->assertSee('Mostrando detalles del usuario: 5');
    }
    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

     /** @test */

     //comprobar si se puede crear usuarios si se envia una peticion de tipo post a la ruta
     //
     function it_creates_a_new_user()
     {

        $this->withoutExceptionHandling();
        $this->post('/usuarios/crear',[
            'name' => 'Dullio',
            'email' => 'dullio@styde.net',
            'password' => '12345'

        ])->assertRedirect('usuarios');

        //comprobar que en la base de datos hay un usuario con las credenciales espesificadas.
        $this->assertCredentials([
            'name'      => 'Dullio',
            'email'     => 'dullio@styde.net',
            'password'  => '12345'
        ]);
     }

     /** @test */

     function the_name_is_requiered()
     {
       
       // $this->withoutExceptionHandling();


        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'',
                'email' =>'dullio@styde.net',
                'password' => '12345'
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['name' =>'El campo nombre es obligatorio']);

        //comprueba que en la db no hay registros guardados, es decir que los registros son cero.                
        $this->assertEquals(0, User::count());


        //para comprobar que en la base de datos users no hay un usaurio que ya tenga el correo que se ingresa.
        $this->assertDatabaseMissing('users',[
            'email' => 'dullio@styde.net',
         ]);
        
     }

     /** @test */

     function the_email_is_requiered()
     {
       
       // $this->withoutExceptionHandling();


        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'daniel',
                'email' =>'',
                'password' => '12345'
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['email' =>'El campo email es obligatorio'
            ]);
        $this->assertEquals(0, User::count());
    }

    /** @test */

    //completa los campos pero elcorreo no es valido.
     function the_email_must_be_valid()
     {
       
       // $this->withoutExceptionHandling();


        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'daniel',
                'email' =>'correo-no-valido',
                'password' => '12345'
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['email' =>'El campo email es obligatorio'
            ]);
        $this->assertEquals(0, User::count());
    }

    /** @test */

    //el email debe ser unico.
     function the_email_must_be_unique()
     {
       
       //$this->withoutExceptionHandling();

        factory(User::class)->create([
            'email' => 'daniel@example.com'
        ]);
        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'daniel',
                'email' =>'daniel@example.com',
                'password' => '12345'
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['email'
            ]);
        $this->assertEquals(1, User::count());
    }


     /** @test */

     function the_password_is_requiered()
     {
       
       // $this->withoutExceptionHandling();


        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'daniel',
                'email' =>'daniel@example.com',
                'password' => ''
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['password' =>'El campo password es obligatorio'
            ]);

        $this->assertEquals(0, User::count());
    }


      /** @test */
    function it_loads_the_edit_user_page()
    {
        
        $user = factory(User::class)->create();
        //$this->withoutExceptionHandling();  
        
        //url----usuarios/id/editar
        $this->get("/usuarios/{$user->id}/editar")//usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee("Editar Usuario")
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
         });   
    }


    /*pruebas para el metodo put o para actualizar los registros

    */

     /** @test */
    function it_updates_a_user()
    {
        
        $user = factory(User::class)->create();
        $this->withoutExceptionHandling();  
        
        $this->put("usuarios/{$user->id}",[
            'name' => 'daniel',
            'email' => 'daniel@example.com',
            'password' =>'123456'
        ])->assertRedirect("usuarios/{$user->id}");

        $this->assertCredentials([
            'name' =>'daniel',
            'email' =>'daniel@example.com',
            'password' => '123456'
        ]);
    }



    
         /** @test */
    function the_name_is_requiered_when_updating_a_user()
     {
       
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' =>'',
                'email' =>'dullio@styde.net',
                'password' => '12345'
            ])  -> assertRedirect("usuarios/{$user->id}/editar")
                ->assertSessionHasErrors(['name' =>'El campo nombre es obligatorio']);

        //comprueba que en la db no hay registros guardados, es decir que los registros son cero.                
       // $this->assertEquals(0, User::count());


        //para comprobar que en la base de datos users no hay un usaurio que ya tenga el correo que se ingresa.
         $this->assertDatabaseMissing('users',[
             'email' => 'dullio@styde.net',
         ]);
        
     }


     /** @test */

     function the_email_is_requiered_when_updating_a_user()
     {
       
       $user = factory(User::class)->create();
     
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' =>'daniel',
                'email' =>'correo-no-valido',
                'password' => '12345'
            ])  -> assertRedirect("usuarios/{$user->id}/editar")
                //->assertSessionHasErrors(['email' =>'El campo email es obligatorio']);
                ->assertSessionHasErrors(['email']);
       
         $this->assertDatabaseMissing('users',[
             'name' => 'daniel'
         ]);
    }

    /** @test */

    //completa los campos pero elcorreo no es valido.
    /* function the_email_must_be_valid_when_updating_a_user()
     {
       
       // $this->withoutExceptionHandling();


        //from para encadenar una url anterior, de donde se espera que se envia la peticion de tipo post
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear',[
                'name' =>'daniel',
                'email' =>'correo-no-valido',
                'password' => '12345'
            ])  -> assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['email' =>'El campo email es obligatorio'
            ]);
        $this->assertEquals(0, User::count());
    }*/

    /** @test */

    //el email debe ser unico.
     function the_email_must_be_unique_when_updating_a_user()
     {
       
      // $this->withoutExceptionHandling();
        
        //se marca prueba cmom imcompleta para q no se ejecute el codigo de abajo
        /*self::markTestIncomplete();
        return;*/


        factory(User::class)->create([
            'email' => 'existing-email@example.com'
        ]);


        $user = factory(User::class)->create([
            'email' => 'daniel@example.com'
        ]);
        
        $this->from("usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name' =>'daniel',
                'email' =>'existing-email@example.com',
                'password' => '12345'
            ])  -> assertRedirect("usuarios/{$user->id}/editar")
                ->assertSessionHasErrors(['email'
            ]);

        //$this->assertEquals(1, User::count());
    }


     /** @test */

     function the_password_is_optional_when_updating_a_user()
     {
        $oldpassword = 'CLAVE_ANTERIOR';
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'password' => bcrypt($oldpassword)
        ]);
     
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' =>'daniel',
                'email' =>'daniel8@example.com',
                'password' => $oldpassword
            ])  
            -> assertRedirect("usuarios/{$user->id}"); //users.show
            //->assertSessionHasErrors(['password' =>'El campo password es obligatorio']);
            //->assertSessionHasErrors(['password']);
       
         $this->assertCredentials([
            'name' => 'daniel',
            'email' => 'daniel8@example.com',
            'password' => $oldpassword
         ]);

    }


     /** @test */

     function the_users_email_can_stay_equals_when_updating_a_user()
     {
        
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email' => 'daniel@example.com'
        ]);
     
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' =>'daniel',
                'email' =>'daniel@example.com',
                'password' => '12345'
            ])  
            -> assertRedirect("usuarios/{$user->id}"); //users.show
            //->assertSessionHasErrors(['password' =>'El campo password es obligatorio']);
            //->assertSessionHasErrors(['password']);
       
         $this->assertDatabaseHas('users',[
            'name' => 'daniel',
            'email' => 'daniel@example.com',
            
         ]);

    }

     /** @test */

     function it_deletes_a_user()
     {
        
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users',[
            'id'=> $user->id
        ]);
     }


}

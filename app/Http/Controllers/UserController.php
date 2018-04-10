<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function index()
    {

        //listado de usuarios estaticos
       /* if(request()->has('empty'))
            $users=[];

        else
            $users = [
                'miguel',
                'manuel',
                'genesis',
                'saray',
                'daniel',
                'juan',
            ];*/

        //listados de usuarios dinamicos.
        

        //constructor de consultas
        //
        //$users = DB::table('users')->get();



        //usando eloquent para cargar usuarios.
        //
        $users = User::all();


        $title = 'Listado de usuarios';

        #helper de laravel dd, es como un var_dump...
        # para compraobar el resultado del llamado de una funcion o los datos de variable

        //dd(compact('title','users'));

       /* return view('users')->with([
            'users'=>$users,
            'title' =>'Listado de usuarios']);
        */
       return view('users.index', compact('users', 'title'));
    }

    public function show(User $user)
    {
                
       
        //$user = User::findOrFail($id);

        //exit('linea no alcanzada');
        //  if($user ==null){
        //     return response()->view('error.404', [], 404);
        // }
        //dd($user);
        return view('users.show', compact('user'));
        
    }

    public function create()
    {
        return view ('users.create');
    }


    public function edit(User $user)
    {
        return view('users.edit',['user'=>$user]);
    }

    public function store()
    {


        //para obtener los datos
        //
        $data = request()->validate([
            'name' => 'required',
            'email' =>['required','email', 'unique:users,email'],
            'password' =>'required',
        ],[
            'name.required'=> 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email es obligatorio',
            'password.required' =>'El campo password es obligatorio'

        ]);

        // if (empty($data['name'])){
        //     return redirect('usuarios/nuevo')->withErrors([
        //         'name'=>'El campo nombre es obligatorio'
        //     ]);
        // }
        //dd($data);
        User::create([
            'name'      =>$data['name'],
            'email'     =>$data['email'],
            'password'  => bcrypt($data['password'])
        ]);

        return redirect()->route('users');
    }

    public function update(User $user)
    {
        
        //dd('actulizar usuarios');
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email', Rule::unique('users')->ignore($user->id)],
            'password' => '',
        ],[
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        if($data['password']!=null){
            $data['password'] = bcrypt($data['password']);
        }else {
            unset($data['password']);
        }

        
        $user->update($data);
        //return redirect("usuarios/{$user->id}");
        return redirect()->route('users.show', ['user'=>$user->id]);
    }

    function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }


}

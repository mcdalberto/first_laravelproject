<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    

    //para espeficicar el nombre de la tabla en caso de que no se utliza la convencion de laravel por defecto
    
    //protected $table='users';
    

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts =[
        'is_admin' => 'boolean', 
    ];


    //funcion para expresar que un usuario solo tiene una profesion y el metodo en singular profession
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }


    public static function findByEmail($email)
    {
        return static::where(compact('email'))
            ->first();
    }

    public function isAdmin()
    {
        return $this->$is_admin;
    }
}

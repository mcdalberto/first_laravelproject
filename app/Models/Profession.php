<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
	protected $fillable =['title'];


	/*relacion con orm eloquent
		se utiliza users porque una profession puede tener varios usuarios al igual que hasMany
	*/
	public function users()
	{
		
		return $this->hasMany(User::class);
	}
}

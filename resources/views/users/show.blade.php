@extends('layout.layout')
@section('title', "Usuario {$user->id}")
@section('content')
   
    <h1>Usuarios #{{$user->id}}</h1>
  	<hr>
			

	<p>Nombre: {{ $user->name}}</p>
	<p>Email: {{ $user->email}}</p>
    <p>
    	
    	<a href="{{ route('users')}}">Regresar</a>
    </p>      	
   

@endsection


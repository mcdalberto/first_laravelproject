
@extends('layout.layout')
@section('title', 'Home')
@section('content')

	
    <div class="title">Página de Inicio.</div>
    <div class="quote">¡Nuestra Página de Inicio!</div>
    
    <button class="btn btn-link">
		<!-- user icons -->
    	<i class="fas fa-user"></i>
		
    </button>      
     <i class="far fa-user"></i>
  		<!--brand icon-->
  	<i class="fab fa-github-square"></i>
  	<span class="fab fa-github-square"></span>
  	<br>
  	<div>
  		<button class="btn btn-link" style="padding:1px;">
  			<span class="fab fa-github-square"></span>
  		</button>
  		<button class="btn btn-link" style="padding:0px;">
		<!-- user icons -->
    		<span class="fas fa-user"></span>
    	</button>  
    	<a href="#" class="btn btn-link" style="padding:0px;">
    		<i class="fas fa-trash-alt"></i>
    	</a>    
    </div>

    
	
@endsection


@extends('layout.layout')
@section('title', "Crear Usuario")
@section('content')
  

   <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
		    // Fetch all the forms we want to apply custom Bootstrap validation styles to
		    var forms = document.getElementsByClassName('needs-validation');
		    // Loop over them and prevent submission
		    var validation = Array.prototype.filter.call(forms, function(form) {
		      form.addEventListener('submit', function(event) {
		        if (form.checkValidity() === false) {
		          event.preventDefault();
		          event.stopPropagation();
		        }
		        form.classList.add('was-validated');
		      }, false);
		    });
		  }, false);
		})();
	</script>

    <h1>Editar Usuario</h1>


  	<hr>

  	@if ($errors->any())
  	<div class ="alert alert-danger">
  		<h6>Por favor corregir los siguientes campos:</h6>
	 	<ul>
			@foreach ($errors->all() as $error)
			<li>
				{{ $error }}
			</li>	 
			
		@endforeach
		</ul>
	</div>
    @endif

	<form method="POST" class="needs-validation" novalidate name="update" action="{{ url("usuarios/{$user->id}")}}">
		{{method_field('PUT')}}
		{!! csrf_field() !!}
		
		<div class="form-row">
			<div class="col-5">
				<label for="name">Nombre</label>
				<input  class="form-control" type="text" name="name" id="name" placeholder="Pedro perez" value="{{ old('name', $user->name)}}" required>
				<div class="invalid-feedback">
					Por favor ingresa un nombre valido.
				<!-- @if ($errors->has('name'))
					<p>{{ $errors -> first('name')}}</p>
				@endif -->
				</div>
			</div>
		</div>
		
		<br>

		<div class="form-row" >
			<div class="col-5">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">
			
				<div class="invalid-feedback">
					Email invalido.
				</div>
			</div>
		</div>
		<br>
		
		<div class ="form-row">
			<div class="col-5">
				<label for="password">Password</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="5 caracteres" required>
			
				<div class="invalid-feedback">
						contraseña invalida.
				</div>
			</div>
		</div>

		<br>
		<button class="btn btn-primary" type="subtmit">Actualizar usuario</button>

	</form>   	
    <a href="{{ route('users')}}">Regresar</a>
    
    <br>
@endsection
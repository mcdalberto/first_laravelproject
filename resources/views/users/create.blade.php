@extends('layout.layout')
@section('title', "Crear Usuario")
@section('content')
  
  <div class="card">
    <div class="card-header">Crear Usuario</div>


    <div class="card-body">
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

      <form method="POST" class="needs-validation" novalidate name="create" action="{{url('/usuarios/crear')}}">
        {!! csrf_field() !!}
        
        <div class="form-row">
          <div>
            <label for="name">Nombre</label>
            <input  class="form-control" type="text" name="name" id="name" placeholder="Pedro perez" value="{{ old('name')}}" required>
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
          <div class="col">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}" >
          
            <div class="invalid-feedback">
              Email invalido.
            </div>
          </div>
        </div>
        <br>
        
        <div class ="form-row">
          <div>
            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="5 caracteres" required>
          </div>
        </div>

        <br>
        <button class="btn btn-primary" type="subtmit">Crear usuario</button>
        <a href="{{ route('users')}}">Regresar</a>

      </form>      

    </div>
  </div>



  

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

    <!-- <form class="needs-validation" novalidate>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">City</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">State</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit">Submit form</button>
</form> -->


@endsection

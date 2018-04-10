@extends('layout.layout')
@section('title', 'Listado de usuarios')
@section('content')
    
   <div class="d-flex justify-content-between align-itmes-end mb-3">
        
        <h1 class="pb-1">{{$title}}</h1>
    <hr>
    
    <p>
       <a href="{{ route('users.create')}}" class="btn btn-primary">Nuevo usuario</a>
    </p>
    </div> 
    
        
    @if($users->isNotEmpty())
        <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Correo</th>
              <th scope="col">Acciones</th>
            </tr>
            </thead>

            
            <tbody>
            @foreach($users as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>                                                 
              <td>{{$user->email}}</td>
              <td>
                
                <form action="{{ route('users.destroy', $user)}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <a href="{{route('users.show', ['id' => $user->id])}}" style="padding: 0px;" class="btn btn-link"><span class="oi oi-eye"></span></a>
                    <a href="{{ route('users.edit',$user)}}"><span class="oi oi-pencil" ></span></a>
                    <button type="submit" style="padding:0px;" class="btn btn-link"><i class="fas fa-trash-alt"></i></span></button> 

                </form> 

              </td>
            </tr>

            @endforeach
            
          </tbody>
        </table>
    @else
        <p>No hay usuarios registrados</p>
    @endif

        
            
@endsection


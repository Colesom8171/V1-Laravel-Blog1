@extends('layouts.app') 

@section('title')
<label>Usuarios</label>
@endsection

@section('content')
<div class="row">

    <div class="col-md-3">
        <a href="{{ url('users/create')}}">
            <button class="btn btn-md btn-success">+ AGREGAR USUARIOS</button>
        </a>

    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Cumpleaños</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
				<?php
				    $i=0;
				?>
				@foreach($users as $user)
				<?php
				    $i++;
				?>
				<tr>
					<td>{{ $i }}</td>
					
                    
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role->name }}</td>    
                    <td>{{ $user->email }}</td>  
                    <td>
                        @if($user->status == 1)
                            ACTIVO
                        @else
                            INACTIVO
                        @endif
                    </td>
                    <td>{{ $user->birthday }}</td>    
					<td>
                        <div>
						    <a class="btn btn-md btn-warning" href="{{url ('users/'.$user->id.'/edit')}}" style="float:left;">Editar</a>
                        </div>
                        <div>
                            <form method="POST" action="{{url ('users/'.$user->id)}}" style="float:left; margin-left:5px">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <!--<button type="submit" class="btn btn-md btn-danger" href="{{url ('users/'.$user->id.'/edit')}}">Eliminar</button>-->
                                <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                            </form>
                        </div>
					</td>
				</tr>

				@endforeach
				
			</tbody>

        </table>
    </div>
    
</div>
@endsection
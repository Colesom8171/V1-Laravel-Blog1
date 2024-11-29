@extends('layouts.app') 

@section('title')
<label>Roles</label>
@endsection

@section('content')
<div>
        <a class="btn btn-md btn-success" href="{{ url('roles/create') }}">+agregar Rol</a>
</div>


    <div class="col-md-12 text-center">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
				<?php
				    $i=0;
				?>
				@foreach($roles as $role)
				<?php
				    $i++;
				?>
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $role->name }}</td>  
					<td>
                        <div>
						    <a class="btn btn-md btn-warning" href="{{url ('roles/'.$role->id.'/edit')}}" style="float:left;">Editar</a>
                        </div>
                        <div>
                            <form method="POST" class="form_delete" action="{{url ('roles/'.$role->id)}}" style="float:left; margin-left:10px">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <input type="submit" class="btn btn-md btn-danger" value="Eliminar">
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
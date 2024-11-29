@extends('layouts.app') 

@section('title')
<label>Categorias</label>
@endsection

@section('content')
<div class="row">

    <div class="col-md-3">
        <a href="{{ url('categories/create')}}">
            <button class="btn btn-md btn-success">+ AGREGAR CATEGORIA</button>
        </a>

    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                </tr>
            </thead>

            <tbody>
				<?php
				    $i=0;
				?>
				@foreach($categories as $category)
				<?php
				    $i++;
				?>
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $category->name }}</td>  
					<td>
						<a class="btn btn-md btn-warning" href="{{url ('categories/'.$category->id.'/edit')}}" style="float:left;">Editar</a>
                        <form method="POST" action="{{url ('categories/'.$category->id)}}" style="float:left; margin-left:5px">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" href="{{url ('categories/'.$category->id.'/edit')}}">Eliminar</button>
                        </form>
					</td>
				</tr>

				@endforeach
				
			</tbody>

        </table>
    </div>
    
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.form_delete').om('submit', function(){
        var resp = confirm('Desea eliminar el elemento?');
        if(!resp){
            return false;
        }
    });
</script>
@endsection
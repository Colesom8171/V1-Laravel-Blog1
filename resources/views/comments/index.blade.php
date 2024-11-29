@extends('layouts.app') 

@section('title')
<label>Comments</label>
@endsection

@section('content')
<div class="row">

<div class="col-md-3">
        <a href="{{ url('comments/create')}}">
            <button class="btn btn-md btn-success">+ AGREGAR COMENTARIO</button>
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
				@foreach($comments as $comment)
				<?php
				$i++;
				?>
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $comment->content }}</td>
                      
					<td>
						<a class="btn btn-md btn-warning" href="{{url ('comments/'.$comment->id.'/edit')}}" style="float:left;">Editar</a>
                        <form method="POST" action="{{url ('comments/'.$comment->id)}}" style="float:left; margin-left:5px">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" href="{{url ('comments/'.$comment->id.'/edit')}}">Eliminar</button>
                        </form>
					</td>
				</tr>

				@endforeach
				
			</tbody>

        </table>
    </div>
    
</div>
@endsection
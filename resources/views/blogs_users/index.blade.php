@extends('layouts.app') 

@section('title')
<label>Blogs</label>
@endsection

@section('content')
<div class="row">

    <div class="col-md-3">
        <a href="{{ url('blogs/create')}}">
            <button class="btn btn-md btn-success">+ AGREGAR BLOG</button>
        </a>

    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Fecha</th>
                    <th>Visitas</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
				@foreach($blogs as $index => $blog)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td>{{ $blog->title }}</td>
                    <td>{{ $blog->user ? $blog->user->name : 'Sin Autor'}}</td>
                    <td>{{ $blog->category ? $blog->category->name : 'Sin Categoria'}}</td>
                    <td>{{ $blog->fecha }}</td>
                      

					<td>
						<a class="btn btn-md btn-warning" href="{{url ('blogs/'.$blog->id.'/edit')}}" style="float:left; margin-left:5px">Editar</a>

                        <form method="POST" action="{{url ('blogs/'.$blog->id)}}" style="float:left; margin-left:5px">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" href="{{url ('blogs/'.$blog->id.'/edit')}}">Eliminar</button>
                        </form>

                        <a class="btn btn-md btn-warning" href="{{url ('blogs/'.$blog->id)}}" style="float:left; margin-left:5px">Vista</a>
                        <!--
                        <form method="POST" action="{{url ('blogs/'.$blog->id)}}" style="float:left; margin-left:5px">
                            <input type="hidden" name="_method" value="GET">
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" href="{{url ('blogs/'.$blog->id.'/edit')}}">Vista</button>
                        </form>
                        -->
					</td>
				</tr>

				@endforeach
				
			</tbody>

        </table>
    </div>
    
</div>
@endsection
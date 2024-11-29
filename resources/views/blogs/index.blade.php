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
        <table id="myTable" class="table table-striped display">
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
                    <td>{{ $blog->visitas }}</td> <!-- Asegúrate de que el campo 'visitas' exista en tu modelo -->
        
                    <td>
                        <a class="btn btn-md btn-warning" href="{{ url('blogs/'.$blog->id.'/edit') }}" style="margin-right: 5px;">Editar</a>

                        <form method="POST" action="{{ url('blogs/'.$blog->id) }}" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este blog?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-danger">Eliminar</button>
                        </form>

                        <a class="btn btn-md btn-info" href="{{ url('blogs/'.$blog->id) }}" style="margin-left: 5px;">Vista</a>
                    </td>

				</tr>

				@endforeach
				
			</tbody>

        </table>


    </div>
    
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        // Opciones de DataTables, ajusta según tus necesidades
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
});
</script>
@endsection
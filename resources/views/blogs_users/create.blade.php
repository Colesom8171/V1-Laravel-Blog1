@extends('layouts.app') 

@section('title')
<label>Blogs</label>
@endsection

@section('content')

<div class="container">
    <h1 class="text-center mt-4 mb-4">Crear Nuevo Blog</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ url('blogs_users') }}" enctype="multipart/form-data">
                @csrf


                <!-- Campo de selección para category_id -->
                <div class="form-group">
                    <label for="category_id">Selecciona una Categoria:</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de selección para tag_id -->
                <div class="form-group">
                    <label for="tags">Selecciona un Tag:</label>
                    <select class="form-control select2" name="tags[]" multiple=true>
                        
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="content">Contenido:</label>
                    <input id="x" type="hidden" name="content">
                    <trix-editor input="x"></trix-editor>
                </div>


                <div class="col-md-6">
                    <label>FECHA:</label>
                    <input type="date" name="fecha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-md btn-success">Enviar</button>
                    <a href="{{ url('/dashboard') }}" class="btn btn-md btn-info">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Seleccione un Tag",
        allowClear: true
    });
});
</script>

<!-- trix no necesita ser inicializado por un script...-->
<script>
    document.addEventListener("trix-change", function(event) {
        const editor = event.target;
        const content = editor.value; // Obtiene el contenido
        console.log(content); // Muestra el contenido en consola, puedes cambiarlo según necesites

        // Aquí puedes hacer otras cosas con el contenido si lo necesitas
    });
</script>
@endsection
@extends('layouts.app') 

@section('title')
<label>Blogs / Editar Blog</label>
@endsection

@section('content')
<!--
<div class="row">

    <form method="POST" action="{{ url('blogs/'.$blog->id)}}">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="from-group">
            <div class="col-md-6">
                <label>NOMBRE:</label>
                <input type="text" name="name" class="form-control" value="{{ $blog->name}}" required>
            </div>
            
            <div class="col-md-6">
                <label>CONTENIDO:</label>
                <input type="text" name="content" class="form-control" value="{{ $blog->content }}" required>
            </div>
        </div>

        <div class="text-center" style="margin-top:15px">
            <button class="btn btn-md btn-success">ACTUALIZAR</button>
            <a href="{{ url('blogs')}}" class="btn btn-md btn-info">CANCELAR</a>
        </div>
    </form>
    
</div>
-->
<div class="container">
    <h1 class="text-center mt-4 mb-4">Editar Blog</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ url('blogs/'.$blog->id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <!-- Campo de selección para user_id -->
                <div class="form-group">
                    <label for="user_id">Selecciona un Usuario:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $blog->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de selección para category_id -->
                <div class="form-group">
                    <label for="category_id">Selecciona una Categoria:</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                

                <!-- Campo de selección para tag_id -->
                <div class="form-group">
                    <label for="tags">Selecciona un Tag:</label>
                    <select class="form-control select2" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" 
                                @if($blog->tags->contains($tag->id)) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Titulo:</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Contenido:</label>
                    <textarea name="content" rows="5" class="form-control" required>{{ $blog->content }}</textarea>
                </div>

                <div class="col-md-6">
                    <label>FECHA:</label>
                    <input type="date" name="fecha" value="{{ $blog->fecha }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Imagen Actual:</label>
                    @if ($blog->image_path)
                    <img src="{{ asset($blog->image_path) }}" class="img-thumbnail" alt="Imagen del Blog">
                    @else
                    <p>No hay imagen disponible</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="new_image">Cambiar Imagen:</label>
                    <input type="file" name="new_image" class="form-control-file">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-md btn-success">Actualizar</button>
                    <a href="{{ url('blogs') }}" class="btn btn-md btn-info">Cancelar</a>
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
@endsection
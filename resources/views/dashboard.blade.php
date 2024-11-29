@extends('layouts.app') 

@section('title')
<label>Dashboard</label>
@endsection

@section('content')
<div class="col-md-12 text-center mb-4">
    <!-- Formulario de búsqueda por categoría y tags-->
    <form method="GET" action="{{ route('dashboard') }}">

        <div class="form-group">
            <label for="category">Buscar por Categoría:</label>
            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">-- Todas las Categorías --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="tags">Buscar por Tags:</label>
            <select name="tags[]" id="tags" class="form-control select2" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, request('tags', [])) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div> -->

        <div class="form-group">
            <label for="tags">Buscar por Tags:</label>
            <select name="tags[]" id="tags" class="form-control select2" multiple>
                @foreach($tags as $tag)
                    

                    <option value="{{ $tag->id }}" {{ in_array($tag->id, (array) request('tags')) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>

                @endforeach
            </select>
        </div>

    </form>
</div>



<div class="col-md-12 text-center">
    <div class="row">
        @foreach($blogs as $blog)
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
            @if ($blog->image_path)
              <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="Imagen del Blog">
            @endif
              <div class="card-body">
                <h3 class="card-title text-bold" style="font-size:25px; font-weight: bodl;">{{$blog->title}}</h3>
                <p class="card-text">Categoria: {{$blog->category->name}}</p>
                <p class="card-text">Tags: 
                    @foreach($blog->tags as $tag)
                        {{$tag->name}} -
                    @endforeach
                </p>
                <a href="{{url ('blogs_users/'.$blog->id)}}" class="btn btn-primary">VER BLOG</a>
              </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section ('scripts')

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Selecciona uno o más tags",
        allowClear: true
    }).on('change', function() {
        console.log("Select2 change event triggered");
        this.form.submit(); // Envia el formulario al cambiar la selección
    });
});

</script>

@endsection
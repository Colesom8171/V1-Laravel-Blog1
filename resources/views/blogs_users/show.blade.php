@extends('layouts.app')

@section('title', 'Detalles del Blog')

@section('content')
<!--
<div class="container">
    <h1>Detalles del Blog</h1>

    <div class="row">
        <div class="col-md-6">
            <label for="name">NOMBRE:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $blog->name }}" readonly>
        </div>
        
        <div class="col-md-6">
            <label for="content">CONTENIDO:</label>
            <textarea id="content" name="content" rows="5" class="form-control" readonly>{{ $blog->content }}</textarea>
        </div>
    </div>

    <div class="text-center" style="margin-top: 15px;">
        <a href="{{ route('blogs.index') }}" class="btn btn-md btn-info">VOLVER</a>
    </div>
</div>
-->
<div class="container">
    <h1 class="text-center mt-4 mb-4">Detalles del Blog</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">

                @if ($blog->image_path)
                <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="Imagen del Blog">
                @endif

                <div class="card-body">
                    <h4 class="card-title">{{ $blog->name }}</h4>
                    <p class="card-text">{{ $blog->content }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('blogs.index') }}" class="btn btn-md btn-info">Volver</a>
    </div>
</div>
@endsection
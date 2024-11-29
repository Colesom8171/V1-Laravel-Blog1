@extends('layouts.app')

@section('title', 'Detalles del Blog')

@section('content')
<div class="container">
    <h1 class="text-center mt-4 mb-4">Detalles del Blog</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">

                @if ($blog->image_path)
                <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="Imagen del Blog">
                @endif

                <div class="card-body">
                    <h4 class="card-title">{{ $blog->title }}</h4>
                    <p class="card-text">{!! $blog->content !!}</p>
                    <p><strong>Usuario:</strong> {{ $blog->user->name }}</p>
                    <p><strong>Rol:</strong> {{ $blog->user->role->name }}</p>
                    <p><strong>Categoría:</strong> {{ $blog->category->name }}</p>
                    <p><strong>Tags:</strong> 
                        @foreach($blog->tags as $tag)
                            <span class="badge badge-info">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <p><strong>Fecha:</strong> {{ $blog->fecha }}</p>
                    <p><strong>Creado el: </strong>{{ $blog->created_at->diffForHumans()}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('blogs.index') }}" class="btn btn-md btn-info">Volver</a>
    </div>
</div>
@endsection

@extends('layouts.app') 

@section('title')
<label>Dashboard</label>
@endsection

@section('content')
<div class="col-md-12 text-center">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{$blog->title}}</h2>

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
                <!-- <p><strong>Fecha:</strong> {{ $blog->fecha }}</p> -->
                <p><strong>Creado el: </strong>{{ $blog->created_at->diffForHumans()}}</p>
            </div>

        </div>

    </div>
</div>

<div class="row text-left">
    <div class="col-md-12 text-left">
        <h3>COMENTARIOS:</h3>
    </div>

    @foreach($blog->comments as $comment)
    <div class="col-md-12">
        <labe class="text-muted">{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans()}}</labe>
        <p>{{ $comment -> content }}</p>
    </div>
        <!--    
        <div>
                <form method="POST" class="form_delete" action="{{ url ('blogs_users/'.$blog->id. '/destroy') }}" >
                    <input type="hidden" name="_method" value="DELETE">
                    @csrf
                    <input type="submit" class="btn btn-md btn-danger" value="Eliminar">
                </form>
        </div>
        -->
        <div>
            
            @if (auth()->user()->id === $comment->user_id || auth()->user()->role_id == '1')
                <form method="POST" class="form_delete" action="{{ url ('comments/'.$comment->id) }}" >
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    
                    <input type="submit" class="btn btn-md btn-danger" value="Eliminar">
                </form>
            @endif
        </div>
    <hr>
    @endforeach


    <form class="row" action="{{ url ('blogs_users/'.$blog->id.'/add_comment') }}" method="POST">
        @csrf
        <div class="col-md-12">
            <textarea name="content" class="form-control">
            </textarea>
        </div>
        
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-sm btn-success">Public</button>
        </div>

        

    </form>
</div>

<div class="row text-center">
    <div style="margin-top: 25px;">
        <a href="{{ url('dashboard') }}" class="btn btn-md btn-info">VOLVER</a>
    </div>
</div>
@endsection
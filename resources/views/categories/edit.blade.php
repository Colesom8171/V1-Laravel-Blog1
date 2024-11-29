@extends('layouts.app') 

@section('title')
<label>Categoria / Editar Categoria</label>
@endsection

@section('content')
<div class="row">

    <form method="POST" action="{{ url('categories/'.$category->id)}}">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="from-group">
            <div class="col-md-6">
                <label>NOMBRE:</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name}}" required>
            </div>
        </div>

        <div class="text-center" style="margin-top:15px">
            <button class="btn btn-md btn-success">ACTUALIZAR</button>
            <a href="{{ url('categories')}}" class="btn btn-md btn-info">CANCELAR</a>
        </div>
    </form>
    
</div>
@endsection
@extends('layouts.app') 

@section('title')
<label>Roles</label>
@endsection

@section('content')
<div class="row">

    <form method="POST" action="{{ url('roles')}}">
        @csrf
        <div class="from-group">
            <div class="col-md-6">
                <label>NOMBRE:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <div class="text-center" style="margin-top:15px">
            <button class="btn btn-md btn-success">ENVIAR</button>
            <a href="{{ url('roles')}}" class="btn btn-md btn-info">CANCELAR</a>
        </div>
    </form>
    
</div>
@endsection
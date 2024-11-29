@extends('layouts.app') 

@section('title')
<label>Usuario / Editar Usuario</label>
@endsection

@section('content')
<div class="row">

    <form method="POST" action="{{ url('users/'.$users->id)}}">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="row from-group">
            <div class="col-md-6">
                <label>NOMBRE:</label>
                <input type="text" name="name" class="form-control" value="{{ $users->name }}" required>
            </div>

            <div class="col-md-6">
                <label>EMAIL:</label>
                <input type="text" name="email" class="form-control" value="{{ $users->email }}" required>
            </div>
        </div>

        <div class="row from-group">
            <div class="col-md-6">
                <label>PASSWORD:</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6">
                <label>ROL:</label>
                <select class="form-control" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id}}"@if($users->role_id == $role->id)selected @endif>{{ $role->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="row from-group">
            <div class="col-md-6">
                <label>CUMPLEAÑOS:</label>
                <input type="date" name="birthday" value="{{ $users->birthday }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label>ESTADO:</label>
                <select class="form-control" name="status">
                    <option value="1" @if($users->status == 1) selected @endif>
                        ACTIVO</option>
                    <option value="0" @if($users->status == 0) selected @endif>
                        INACTIVO</option>
                </select>
            </div>
        </div>

        <div class="text-center" style="margin-top:15px">
            <button class="btn btn-md btn-success">ACTUALIZAR</button>
            <a class="btn btn-md btn-info" href="{{ url('users')}}">CANCELAR</a>
        </div>
    </form>
    
</div>
@endsection
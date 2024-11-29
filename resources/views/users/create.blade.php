@extends('layouts.app') 

@section('title')
<label>Users</label>
@endsection

@section('content')
<div class="row">

    <form method="POST" action="{{ url('users')}}">
        @csrf
        <div class="row from-group">
            <div class="col-md-6">
                <label>NOMBRE:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>EMAIL:</label>
                <input type="text" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row from-group">
            <div class="col-md-6">
                <label>PASSWORD:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>ROLES:</label>
                <select class="form-control" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id}}">{{ $role->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="row from-group">
            <div class="col-md-6">
                <label>CUMPLEAÑOS:</label>
                <input type="date" name="birthday" class="form-control">
            </div>

            <div class="col-md-6">
                <label>ESTADO:</label>
                <select class="form-control" name="status">
                    <option value="1">ACTIVO</option>
                    <option value="0">INACTIVO</option>
                </select>
            </div>
        </div>
        

        <div class="text-center" style="margin-top:15px">
            <button class="btn btn-md btn-success">ENVIAR</button>
            <a href="{{ url('users')}}" class="btn btn-md btn-info">CANCELAR</a>
        </div>
    </form>
    
</div>
@endsection
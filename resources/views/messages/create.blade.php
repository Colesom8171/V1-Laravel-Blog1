@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enviar mensaje</h1>
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="receiver_id">Seleccionar usuario</label>
            <select id="receiver_id" name="receiver_id" class="form-control select2">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Mensaje</label>
            <textarea id="content" name="content" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Enviar</button>
    </form>
</div>
@endsection

@section ('scripts')
<script>
    $(document).ready(function () {
        $('.select2').select2();
        
    });
</script>
@endsection
<!-- messages/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mensaje</h1>

    <div>
        <strong>De:</strong> {{ $message->sender->name }}
    </div>
    <div>
        <strong>Mensaje:</strong> {{ $message->content }}
    </div>
    <div>
        <strong>Fecha:</strong> 
        @if($message->created_at)
            {{ $message->created_at->format('d/m/Y H:i') }}
        @else
            No disponible
        @endif
    </div>
</div>
@endsection

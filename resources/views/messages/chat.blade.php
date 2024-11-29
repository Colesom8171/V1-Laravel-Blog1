@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat con {{ $receiver->name }}</h3>

    <!-- Contenedor de mensajes -->
    <div id="chatBox" class="border rounded p-3" style="height: 400px; overflow-y: scroll; background-color: #f9f9f9;">
        @foreach ($messages as $message)
            @if ($message->sender_id === auth()->id())
                <!-- Mensaje enviado -->
                <div class="text-end">
                    <div class="d-inline-block p-2 mb-2 bg-primary text-white rounded">
                        {{ $message->content }}
                    </div>
                    <div class="text-muted small">{{ $message->created_at->format('H:i') }}</div>
                </div>
            @else
                <!-- Mensaje recibido -->
                <div class="text-start">
                    <div class="d-inline-block p-2 mb-2 bg-light border rounded">
                        {{ $message->content }}
                    </div>
                    <div class="text-muted small">{{ $message->created_at->format('H:i') }}</div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Formulario para enviar mensajes -->
    <form method="POST" action="{{ route('messages.store') }}" class="mt-3">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <div class="input-group">
            <input type="text" name="content" class="form-control" placeholder="Escribe un mensaje..." required>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Scroll automático al final del chat
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection

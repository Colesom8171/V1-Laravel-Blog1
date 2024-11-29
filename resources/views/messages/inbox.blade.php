@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bandeja de entrada</h1>

    @if($contacts->isEmpty())
        <p class="text-center">No tienes conversaciones aún.</p>
    @else
        <div class="list-group">
            @foreach ($contacts as $contact)
                <a href="{{ route('messages.chat', $contact->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $contact->name }}</strong>
                        <p class="mb-0 text-muted small">Último mensaje: 
                            @php
                                $lastMessage = \App\Models\Message::where(function ($query) use ($contact) {
                                    $query->where('sender_id', auth()->id())
                                          ->where('receiver_id', $contact->id);
                                })->orWhere(function ($query) use ($contact) {
                                    $query->where('sender_id', $contact->id)
                                          ->where('receiver_id', auth()->id());
                                })->latest()->first();
                            @endphp
                            {{ $lastMessage ? Str::limit($lastMessage->content, 30) : 'Sin mensajes aún' }}
                        </p>
                    </div>
                    <span class="text-muted small">
                        @if ($lastMessage)
                            {{ $lastMessage->created_at->format('d/m/Y H:i') }}
                        @endif
                    </span>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bandeja de entrada</h1>
    <!-- Botón para crear mensaje -->
    <a href="{{ route('messages.create') }}" class="btn btn-success mb-3">Enviar mensaje</a>

    <a href="{{ route('messages.inbox') }}" class="btn btn-primary">Bandeja de Entrada</a>


    <table id="messagesTable" class="table table-striped">
        <thead>
            <tr>
                <th>De</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($messages as $message)
            <tr>
                <td>{{ $message->sender->name }}</td>
                <td>{{ Str::limit($message->content, 50) }}</td>
                
                <td>
                    @if($message->created_at)
                        {{ $message->created_at->format('d/m/Y H:i') }}
                    @else
                        Fecha no disponible
                    @endif
                </td>

                <td>
                    <a href="{{ route('messages.show', $message->id) }}" class="btn btn-primary btn-sm">Leer</a>
                </td>

                <td>

                    <form method="POST" action="{{ route('messages.destroy', $message->id) }}" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este mensaje?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-md btn-danger">Eliminar</button>
                    </form>

                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No hay mensajes en la bandeja de entrada.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
    
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#messagesTable').DataTable({
            columnDefs: [
                { targets: [0, 1, 2, 3, 4], defaultContent: "-" }
            ],
            order: [[2, 'DESC']], // Ordenar por fecha, de más reciente a más antiguo
            searching: true, // Habilitar búsqueda
            paging: true, // Habilitar paginación
        });
    });
</script>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', auth()->id())->with('sender')->get();
        //return view('messages.index', compact('messages'));

        //$messages = Message::with('sender')->get();
        /*
        $messages = Message::with('sender')->get()->map(function ($message) {
            return [
                'sender' => $message->sender->name,
                'content' => $message->content,
                'created_at' => $message->created_at->format('d/m/Y H:i'),
                'actions' => '<a href="'.route('messages.show', $message->id).'" class="btn btn-primary btn-sm">Leer</a>',
            ];
        });
        */
        //$messages = Message::get();
        //dd($messages);

        
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        // Verifica que se guardó correctamente
        //dd($message);

        //return redirect()->route('messages.index')->with('success', 'Mensaje enviado.');

        return redirect()->route('messages.chat', $request->receiver_id)
                     ->with('success', 'Mensaje enviado con éxito.');
    }

    public function show($id)
    {
        //$message = Message::where('id', $id)->where('receiver_id', auth()->id())->with('sender')->firstOrFail();
        //$message->update(['is_read' => true]);
        //return view('messages.show', compact('message'));

        $message = Message::where('id', $id)
            ->where('receiver_id', auth()->id())
            ->with('sender')
            ->firstOrFail();

        if ($message->created_at) {
            $formattedDate = $message->created_at->format('d/m/Y H:i');
        } else {
            $formattedDate = 'Fecha no disponible';
        }
        // Agrega esto para asegurarte de que 'sender' está cargado correctamente
        //dd($message);

        $message->update(['is_read' => true]);
        return view('messages.show', compact('message', 'formattedDate'));
    }

    public function destroy(Request $request, string $id)
    {

        $message = Message::where('id', $id)->first();
        // Verifica si el comentario existe
        /*
        if (!$message) {
            return redirect()->back()->with('error', 'Comentario no encontrado.');
        }
        // Permitir eliminar si es el propietario o si es un administrador
        if ($message->user_id !== auth()->user()->id && auth()->user()->role_id !== 1) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }
        */

        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Mensaje eliminado con éxito.');

    }

    public function chat($receiverId)
    {
        $authUserId = auth()->id();

        // Obtener mensajes entre el usuario autenticado y el receptor
        $messages = Message::where(function ($query) use ($authUserId, $receiverId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($authUserId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $authUserId);
        })->orderBy('created_at', 'asc')->get();

        // Pasar los mensajes y el receptor a la vista
        $receiver = User::findOrFail($receiverId);

        return view('messages.chat', compact('messages', 'receiver'));
    }

    public function inbox()
    {
        $authUserId = auth()->id();

        // Obtener usuarios con los que el usuario autenticado ha interactuado
        $contacts = User::whereHas('sentMessages', function ($query) use ($authUserId) {
            $query->where('receiver_id', $authUserId);
        })->orWhereHas('receivedMessages', function ($query) use ($authUserId) {
            $query->where('sender_id', $authUserId);
        })->get();

        return view('messages.inbox', compact('contacts'));
    }



}


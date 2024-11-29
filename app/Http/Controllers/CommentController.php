<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        $comment = Comment::create($request->all());
        return redirect('comments');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $comment = Comment::find($id);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);

        $comment = Comment::find($id);
        $comment->fill($request->all());
        
        $comment->save();

        return redirect('comments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        //$comment = Comment::find($id);

        /*
        // Busca el comentario por ID y asegúrate de que pertenece al usuario
        $comment = Comment::where('id', $id)
                      ->where('user_id', auth()->user()->id)
                      ->first();
        // Verifica si el comentario existe
        if (!$comment) {
        return redirect()->back()->with('error', 'Comentario no encontrado o no tienes permiso para eliminarlo.');
        }
        */
        
        /*
        $comment = Comment::find([
            'user_id' => auth()->user()->id,
            'blog_id' => $id,
            'content' => $request->content
        ]);
        */

        //
        $comment = Comment::where('id', $id)->first();
        // Verifica si el comentario existe
        if (!$comment) {
            return redirect()->back()->with('error', 'Comentario no encontrado.');
        }
        // Permitir eliminar si es el propietario o si es un administrador
        if ($comment->user_id !== auth()->user()->id && auth()->user()->role_id !== 1) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }

        $comment->delete();

        return redirect('blogs_users/' . $comment->blog_id);
    }
}

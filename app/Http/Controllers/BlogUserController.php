<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Comment;
//use App\Models\User;

use Illuminate\Support\Facades\Storage;

class BlogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = Blog::orderBy('id', 'DESC')->get();
        //dd($blogs);

        return view ('dashboard', compact ('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        //$users = User::get();
        $categories = Category::get();
        $tags = Tag::get();
        return view('blogs_users.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $user = auth()->user();
        $request['user_id'] = $user->id;

        $request->validate([
        //'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        'tags' => 'required|array', // Asegúrate de que los tags sean un array
        'tags.*' => 'exists:tags,id' // Validación de cada tag

        ]);

        
        
        //dd($request->all());
        //dd($user);
        //dd($user->id);     
        
        // Procesar la imagen y guardarla
        $imagePath = null; // Inicializa la variable
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName; // Asigna la ruta de la imagen
        }

        $blog = Blog::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'fecha' => $request->fecha,
            'image_path' => $imagePath, // Incluye la ruta de la imagen
        ]);

        // Guardar las relaciones de tags
        if ($request->has('tags')) {
            foreach ($request->tags as $tag_id) {
                BlogTag::create([
                    'blog_id' => $blog->id,
                    'tag_id' => $tag_id
                ]);
            }
        }

        return redirect('/dashboard')->with('success', 'Blog creado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //$blog = Blog::with(['user', 'category', 'tags'])->findOrFail($id);
        //return view('blogs.show', ['blog' => $blog]); // Retorna la vista 'posts.show' con el post recuperado
        //dd('exito');
        

        //$blog = Blog::find($id);
        //return view('view_blog', compact('blog'));

        $blog = Blog::with('comments')->find($id);

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog no encontrado.');
        }

        return view('view_blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        /*
        //dd($request->all());
        //
        //$comment = Comment::find([
        //    'user_id' => auth()->user()->id,
        //    'blog_id' => $id,
        //    'content' => $request->content
        //]);
        //
        $comment = Comment::find($id);
        // Verifica si el comentario existe
        if (!$comment) {
            // Maneja el caso donde no se encuentra el comentario
            return redirect()->back()->with('error', 'Comentario no encontrado.');
        }

        $comment->delete();

        //$role = Role::find($id);
        //$role->delete();

        

        return redirect('blogs_users/'.$id);
        */
    }

    public function add_comment(Request $request, $id)
    {
        //dd($request->all());
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'blog_id' => $id,
            'content' => $request->content
        ]);

        

        return redirect('blogs_users/'.$id);
    }
    /*
    public function delete_comment(Request $request, $id)
    {
        //dd($request->all());
        $comment = Comment::find([
            'user_id' => auth()->user()->id,
            'blog_id' => $id,
            'content' => $request->content
        ]);

        //$comment = Comment::find($id);

        $comment->delete();

        //$role = Role::find($id);
        //$role->delete();

        

        return redirect('blogs_users/'.$id);
    }
    */

    /*
    public function dashboard(Request $request)
    {
    // Obtener todas las categorías
    $categories = Category::all();

    // Filtrar los blogs según la categoría seleccionada, si existe
    $categoryId = $request->input('category');
    if ($categoryId) {
        $blogs = Blog::where('category_id', $categoryId)->get();
    } else {
        $blogs = Blog::all();
    }

    return view('dashboard', compact('blogs', 'categories'));
    }
    */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$blogs = Blog::get();
        // Obtenemos los blogs ordenados por fecha de creación de más nuevo a más antiguo
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        //$blogs = Blog::paginate(100);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::get();
        $categories = Category::get();
        $tags = Tag::get();
        return view('blogs.create', compact('users','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all()); // Esto te permitirá ver todos los datos enviados
        //dd($request->all());
        /*
        $request->validate([
            'name' => 'required'
        ]);
        $blog = Blog::create($request->all());
        return redirect('blogs');
        */
        //
        $request->validate([
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        'tags' => 'required|array', // Asegúrate de que los tags sean un array
        'tags.*' => 'exists:tags,id' // Validación de cada tag

        ]);

        // Procesar la imagen y guardarla
        $imagePath = null; // Inicializa la variable
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName; // Asigna la ruta de la imagen
        }

        // Crear el nuevo blog
        /*
        $blog = new Blog();
        $blog->user_id = $request->input('user_id');
        $blog->category_id = $request->input('category_id');
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->fecha = $request->fecha;
        $blog->image_path = $imagePath; // Asignar la ruta de la imagen al modelo

        $blog->save();
        */
        //$blog = Blog::create($request->all());
        // Crear el nuevo blog con la imagen
        $blog = Blog::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'fecha' => $request->fecha,
            'image_path' => $imagePath, // Incluye la ruta de la imagen
        ]);
        /*
        foreach($request->tags as $tag_id){
            $blog_tags = BlogTag::create([
                'blog_id' => $blog->id,
                'tag_id' => $tag_id
            ]);
        }
        */
        // Guardar las relaciones de tags
        if ($request->has('tags')) {
            foreach ($request->tags as $tag_id) {
                BlogTag::create([
                    'blog_id' => $blog->id,
                    'tag_id' => $tag_id
                ]);
            }
        }
        return redirect()->route('blogs.index')->with('success', 'Blog creado exitosamente.');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        /*
        $blog = Blog::find($id);
        if (!$blog) {
            abort(404); // Manejo de caso donde no se encuentra el blog
        }
        return view('blogs.show', compact('blog'));
        */
        //$blog = Blog::findOrFail($id); // Recupera un post por su ID, o lanza una excepción si no se encuentra
        $blog = Blog::with(['user', 'category', 'tags'])->findOrFail($id);
        return view('blogs.show', ['blog' => $blog]); // Retorna la vista 'posts.show' con el post recuperado
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        //$blog = Blog::findOrFail($id);
        $blog = Blog::with('tags')->findOrFail($id); // Asegúrate de que estás cargando los tags
        $users = User::get();
        $categories = Category::get();
        $tags = Tag::get();

        return view('blogs.edit', compact('blog', 'users', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'content' => 'required',
            //'fecha' => 'required',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la nueva imagen
        ]);
        /*
        $blog = Blog::find($id);
        $blog->fill($request->all());
        
        $blog->save();

        return redirect('blogs');
        */
        $blog = Blog::findOrFail($id);
        // Actualizar nombre y contenido
        $blog->user_id = $request->input('user_id');
        $blog->category_id = $request->input('category_id');
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->fecha = $request->fecha;
        // Procesar la nueva imagen si se proporciona
        if ($request->hasFile('new_image')) {
            // Eliminar la imagen anterior si existe
            if ($blog->image_path) {
                Storage::delete($blog->image_path);
            }
            // Subir la nueva imagen y actualizar la ruta en la base de datos
            $image = $request->file('new_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
            $blog->image_path = $imagePath;
        }
        $blog->save();

        $blog_tags = BlogTag::where('blog_id', $blog->id)->delete();
        foreach($request->tags as $tag_id){
            $blog_tags = BlogTag::create([
                'blog_id' => $blog->id,
                'tag_id' => $tag_id
            ]);
        }    

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Blog actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //$blog = Blog::find($id);
        //$blog->delete();

        $blog = Blog::findOrFail($id);
        if ($blog->image_path) {
            Storage::delete($blog->image_path); // Eliminar la imagen asociada
        }
        $blog->delete();

        return redirect('blogs');
    }
    /**
    *public function vista(string $id)
    *{
    *    //
    *    
    *    $blog = Blog::find($id);
    *
    *    return view('blogs.vista', compact('blog'));
    *}
    */

    public function dashboard(Request $request)
    {
        /*
        // Obtener todas las categorías
        $categories = Category::all();
        // Obten todos los tags
        $tags = Tag::all();

        // Filtrar los blogs según la categoría y tag seleccionados, si existen
        $categoryId = $request->input('category');
        $tagIds = $request->input('tags', []); // Agregar esta línea

        $blogs = Blog::when($categoryId, function($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })->when($tagIds, function($query) use ($tagIds) {
            return $query->whereHas('tags', function($q) use ($tagIds) {
                $q->whereIn('tags.id', $tagIds);
            });
        })->get();

        return view('dashboard', compact('blogs', 'categories', 'tags')); // Agregar 'tags' aquí
        }
        */

    // Obtener todas las categorías
    $categories = Category::all();
    $tags = Tag::all(); // Asegúrate de tener acceso a los tags

    // Filtrar los blogs según la categoría y los tags seleccionados
    $categoryId = $request->input('category');
    $tagIds = $request->input('tags', []); // Asegúrate de que sea un array
    $tagNames = Tag::whereIn('id', $tagIds)->pluck('name')->toArray(); // Obtener nombres de los tags seleccionados

    $query = Blog::query();

    // Aplica el filtro de categoría si está definido
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    // Aplica el filtro de tags si hay alguno seleccionado
    
    if (!empty($tagNames)) {
        $query->whereHas('tags', function ($q) use ($tagNames) {
            $q->whereIn('tags.name', $tagNames); // Filtra solo por nombres de tags
        });
    }
    

    // Filtrar por tags, si hay tags seleccionados
    /*
    if (!empty($tagIds)) {
        $query->whereHas('tags', function ($q) use ($tagIds) {
            $q->whereIn('tags.id', $tagIds)
            // Puedes agregar una condición orWhere adicional si necesitas más flexibilidad
            ->orWhere('tags.id', 1); // Ejemplo de otra condición con un tag específico
        });
    }
    */

    //$blogs = $query->get();

    // Ordenar los blogs de más reciente a más antiguo
    $blogs = $query->orderBy('created_at', 'desc')->get(); // 'desc' para orden descendente


    return view('dashboard', compact('blogs', 'categories', 'tags'));
}
}
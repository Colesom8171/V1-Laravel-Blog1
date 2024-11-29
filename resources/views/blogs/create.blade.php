@extends('layouts.app') 

@section('title')
<label>Blogs</label>
@endsection

@section('content')

<div class="container">
    <h1 class="text-center mt-4 mb-4">Crear Nuevo Blog</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ url('blogs') }}" enctype="multipart/form-data">
                @csrf

                <!-- Campo de selección para user_id -->
                <div class="form-group">
                    <label for="user_id">Selecciona un Usuario:</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de selección para category_id -->
                <div class="form-group">
                    <label for="category_id">Selecciona una Categoria:</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de selección para tag_id -->
                <div class="form-group">
                    <label for="tags">Selecciona un Tag:</label>
                    <select class="form-control select2" name="tags[]" multiple=true>
                        
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="content">Contenido:</label>
                    <input id="x" type="hidden" name="content">
                    <trix-editor input="x"></trix-editor>
                </div>

                <div class="col-md-6">
                    <label>FECHA:</label>
                    <input type="date" name="fecha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" class="form-control-file" id="image" onchange="previewImage(event)">
                </div>

                <!-- Contenedor para la previsualización -->
                <div class="form-group">
                    <label for="preview">Previsualización:</label>
                    <img id="preview" src="" alt="Vista previa" style="max-width: 100%; display: none;"/>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-md btn-success">Enviar</button>
                    <a href="{{ url('blogs') }}" class="btn btn-md btn-info">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Seleccione un Tag",
        allowClear: true
    });
});
</script>

<!--
<script>
tinymce.init({
    selector: '#content', // Selector del textarea
    plugins: 'lists link image preview', // Plugins que deseas usar
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
    height: 300,
    placeholder: 'Escribe el contenido aquí...',
});
</script>
-->

<!--
<script>
const editorElement = document.querySelector('#content');

    ClassicEditor
        .create(editorElement)
        .then(editor => {
            editorElement.form.addEventListener('submit', (event) => {
                // Copia el contenido del editor al textarea
                editor.getData().then(data => {
                    editorElement.value = data; // Asigna el contenido al textarea

                    if (!data.trim()) {
                        event.preventDefault(); // Evita el envío si el contenido está vacío
                        alert('El contenido es obligatorio.'); // Mensaje de error
                    }
                }).catch(error => {
                    console.error(error);
                });
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
-->

<!--
<script>
const quill = new Quill('#content', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline'],
            ['link', 'image'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'header': [1, 2, false] }]
        ]
    }
});

// Al enviar el formulario
document.querySelector('form').addEventListener('submit', function(event) {
    const content = quill.root.innerHTML;
    document.querySelector('input[name="content"]').value = content;

    if (!content.trim()) {
        event.preventDefault();
        alert('El contenido es obligatorio.');
    }
});
</script>
-->
<!-- trix no necesita ser inicializado por un script...-->
<script>
    document.addEventListener("trix-change", function(event) {
        const editor = event.target;
        const content = editor.value; // Obtiene el contenido
        console.log(content); // Muestra el contenido en consola, puedes cambiarlo según necesites

        // Aquí puedes hacer otras cosas con el contenido si lo necesitas
    });
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        var image = document.getElementById('preview');
        
        // Cuando la imagen se cargue, mostramos la previsualización
        reader.onload = function() {
            image.src = reader.result;
            image.style.display = 'block';  // Aseguramos que la imagen se muestre
        }
        
        // Verificamos si hay un archivo seleccionado
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]); // Leemos el archivo como una URL
        }
    }
</script>
@endsection
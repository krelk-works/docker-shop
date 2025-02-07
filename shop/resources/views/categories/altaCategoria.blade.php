<div class="container">
    <h2>Crear Nueva Categoría</h2>

    {{-- Formulario para crear una categoría --}}
    <form action="{{ route('category.store') }}" method="POST">
        @csrf {{-- Token de seguridad obligatorio en Laravel --}}
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Categoría</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
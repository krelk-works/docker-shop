
<div class="container">
    <h2>Registrar Nuevo Calzado</h2>
    
    {{-- Formulario para registrar un calzado --}}
    <form action="{{ route('shoe.store') }}" method="POST">
        @csrf {{-- Token de seguridad obligatorio en Laravel --}}
        
        <div>
            <label for="name" class="form-label">Nombre del Calzado</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div>
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div>
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>

        <div>
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
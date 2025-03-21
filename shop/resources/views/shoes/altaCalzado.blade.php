
@extends('layouts.app')

@section('content')
    <!-- El contenido de tu formulario aquí -->

    <div class="container">
        
        <h3 class="my-4">Registrar Nuevo Calzado</h2>

    {{-- Formulario para registrar un calzado --}}
    <form action="{{ route('shoe.store') }}" enctype="multipart/form-data" method="POST">
        @csrf {{-- Token de seguridad obligatorio en Laravel --}}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Nombre del Calzado</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo" class="form-label">Foto del Calzado</label>
                    <input type="file" name="photo" id="photo" class="form-control" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
 


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
         

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                    @error('price')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

           
   

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
                    
       
        <div class="form-group mt-4">
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('shoe.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        
    </form>
</div>
@endsection


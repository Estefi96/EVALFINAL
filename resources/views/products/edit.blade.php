@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Producto</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $product->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion_corta" class="form-label">Descripción corta</label>
            <input type="text" name="descripcion_corta" class="form-control" value="{{ old('descripcion_corta', $product->descripcion_corta) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion_larga" class="form-label">Descripción larga</label>
            <textarea name="descripcion_larga" class="form-control" rows="4" required>{{ old('descripcion_larga', $product->descripcion_larga) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="imagen_url" class="form-label">URL de imagen</label>
            <input type="url" name="imagen_url" class="form-control" value="{{ old('imagen_url', $product->imagen_url) }}">
        </div>

        <div class="mb-3">
            <label for="precio_neto" class="form-label">Precio Neto</label>
            <input type="number" name="precio_neto" class="form-control" value="{{ old('precio_neto', $product->precio_neto) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock_actual" class="form-label">Stock Actual</label>
            <input type="number" name="stock_actual" class="form-control" value="{{ old('stock_actual', $product->stock_actual) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
            <input type="number" name="stock_minimo" class="form-control" value="{{ old('stock_minimo', $product->stock_minimo) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock_alto" class="form-label">Stock Alto</label>
            <input type="number" name="stock_alto" class="form-control" value="{{ old('stock_alto', $product->stock_alto) }}" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="stock_bajo" class="form-check-input" value="1" {{ $product->stock_bajo ? 'checked' : '' }}>
            <label class="form-check-label" for="stock_bajo">¿Stock bajo?</label>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
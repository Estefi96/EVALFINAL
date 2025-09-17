@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">Precio</label>
    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
  </div>
  <div class="col-12">
    <label class="form-label">Descripción</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">Guardar</button>
  <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancelar</a>
</div>

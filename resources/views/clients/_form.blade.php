@csrf
<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">Teléfono</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
  </div>
  <div class="col-12">
    <label class="form-label">Dirección</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $client->address ?? '') }}">
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">Guardar</button>
  <a class="btn btn-secondary" href="{{ route('clients.index') }}">Cancelar</a>
</div>

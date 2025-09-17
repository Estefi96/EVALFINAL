@csrf
<div class="row g-3">
  <div class="col-md-3">
    <label class="form-label">RUT</label>
    <input type="text" name="rut" class="form-control" value="{{ old('rut', $user->rut ?? '') }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">Apellido</label>
    <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $user->lastname ?? '') }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
  </div>
  @if(!isset($user))
    <div class="col-md-3">
      <label class="form-label">Contraseña</label>
      <input type="password" name="password" class="form-control" required>
    </div>
  @endif
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">Guardar</button>
  <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancelar</a>
</div>

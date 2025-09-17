<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1 class="h4 mb-4 text-center">Iniciar sesión</h1>

          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <form action="{{ route('login.attempt') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label class="form-label">Correo institucional</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" required>
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
          </form>
        </div>
      </div>
      <p class="text-center text-muted mt-3">
        ejemplo para validar: <code>admin.root@ventasfix.cl</code> / <code>secret123</code>
      </p>
    </div>
  </div>
</div>
</body>
</html>

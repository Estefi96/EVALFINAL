@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Agregar Cliente</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
        </div>

        <div class="mb-3">
            <label for="rut_empresa" class="form-label">RUT Empresa</label>
            <input type="text" name="rut_empresa" class="form-control" value="{{ old('rut_empresa') }}" required>
        </div>

        <div class="mb-3">
            <label for="rubro" class="form-label">Rubro</label>
            <input type="text" name="rubro" class="form-control" value="{{ old('rubro') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>

        <div class="mb-3">
            <label for="email_contacto" class="form-label">Email de Contacto</label>
            <input type="email" name="email_contacto" class="form-control" value="{{ old('email_contacto') }}" required>
        </div>

        <div class="mb-3">
            <label for="nombre_contacto" class="form-label">Nombre del Contacto</label>
            <input type="text" name="nombre_contacto" class="form-control" value="{{ old('nombre_contacto') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
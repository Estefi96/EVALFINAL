@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="mb-4">Bienvenido a VentasFix</h1>
    <p class="lead mb-5">Sistema de gestión de usuarios, productos y clientes.</p>

    <div class="d-grid gap-3 col-6 mx-auto">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Ingresar al Sistema</a>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Ver Usuarios</a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-success">Ver Productos</a>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-info">Ver Clientes</a>
    </div>
</div>
@endsection


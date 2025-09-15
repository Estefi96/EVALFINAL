@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Panel de Administración</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usuarios }}</h5>
                    <p class="card-text">Usuarios registrados en el sistema.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $productos }}</h5>
                    <p class="card-text">Productos disponibles en la plataforma.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Clientes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $clientes }}</h5>
                    <p class="card-text">Clientes registrados en VentasFix.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
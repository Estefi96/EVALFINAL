@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Listado de Clientes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Agregar Cliente</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT Empresa</th>
                <th>Razón Social</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->rut_empresa }}</td>
                <td>{{ $client->razon_social }}</td>
                <td>{{ $client->nombre }}</td>
                <td>{{ $client->email_contacto }}</td>
                <td>{{ $client->telefono }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clients->links() }}
</div>
@endsection
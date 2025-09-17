@extends('layouts.app')
@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Usuarios</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered align-middle">
    <thead>
      <tr>
        <th>ID</th>
        <th>RUT</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th style="width: 160px;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->rut }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->email }}</td>
        <td class="d-flex gap-2">
          <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user->id) }}">Editar</a>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Eliminar usuario?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Eliminar</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" class="text-center text-muted">Sin registros</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

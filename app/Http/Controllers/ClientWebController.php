<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientWebController extends Controller
{
    public function index()
    {
        $clients = Cliente::paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'email_contacto' => 'required|email|unique:clientes,email_contacto',
            'razon_social' => 'required|string',
            'rut_empresa' => 'required|string|unique:clientes,rut_empresa',
            'rubro' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Cliente::create($request->only([
            'nombre',
            'email_contacto',
            'razon_social',
            'rut_empresa',
            'rubro',
            'telefono',
            'direccion',
            'nombre_contacto'
        ]));

        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente');
    }

    public function edit($id)
    {
        $client = Cliente::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Cliente::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'email_contacto' => 'required|email|unique:clientes,email_contacto,' . $id,
            'razon_social' => 'required|string',
            'rut_empresa' => 'required|string|unique:clientes,rut_empresa,' . $id,
            'rubro' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client->update($request->only([
            'nombre',
            'email_contacto',
            'razon_social',
            'rut_empresa',
            'rubro',
            'telefono',
            'direccion',
            'nombre_contacto'
        ]));

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy($id)
    {
        $client = Cliente::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
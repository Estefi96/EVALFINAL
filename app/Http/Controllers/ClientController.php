<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends Controller
{
    public function list()
    {
        $clients = Cliente::all();
        return response()->json($clients);
    }

    public function get($id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($client);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'email_contacto' => 'sometimes|required|email|unique:clientes,email_contacto',
            'razon_social' => 'required|string',
            'rut_empresa' => 'sometimes|required|string|unique:clientes,rut_empresa',
            'rubro' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'contacto' => 'required|string',
        ]);

         if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], jsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => 'Cliente creado exitosamente',
            'client'    => Cliente::create([
                'nombre' => $request->nombre,
                'email_contacto' => $request->email_contacto,
                'razon_social' => $request->razon_social,
                'rut_empresa' => $request->rut_empresa,
                'rubro' => $request->rubro,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'contacto' => $request->contacto,
            ])
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string',
            'email_contacto' => 'sometimes|required|email|unique:clientes,email_contacto,' . $id,
            'razon_social' => 'sometimes|required|string',
            'rut_empresa' => 'sometimes|required|string|unique:clientes,rut_empresa,' . $id,
            'rubro' => 'sometimes|required|string',
            'telefono' => 'sometimes|required|string',
            'direccion' => 'sometimes|required|string',
            'contacto' => 'sometimes|required|string',
        ]);

        $client->update($validated);
        return response()->json($client);
    }

    public function delete($id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $client->delete();
        return response()->json(['message' => 'Cliente eliminado']);
    }
}




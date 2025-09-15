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
        return response()->json(Cliente::paginate(10));
    }

    public function get($id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($client);
    }

    public function create(Request $request)
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
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $client = Cliente::create([
            'nombre' => $request->nombre,
            'email_contacto' => $request->email_contacto,
            'razon_social' => $request->razon_social,
            'rut_empresa' => $request->rut_empresa,
            'rubro' => $request->rubro,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'nombre_contacto' => $request->nombre_contacto,
        ]);

        return response()->json([
            'message' => 'Cliente creado exitosamente',
            'client' => $client
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string',
            'email_contacto' => 'sometimes|required|email|unique:clientes,email_contacto,' . $id,
            'razon_social' => 'sometimes|required|string',
            'rut_empresa' => 'sometimes|required|string|unique:clientes,rut_empresa,' . $id,
            'rubro' => 'sometimes|required|string',
            'telefono' => 'sometimes|required|string',
            'direccion' => 'sometimes|required|string',
            'nombre_contacto' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
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

        return response()->json([
            'message' => 'Cliente actualizado exitosamente',
            'client' => $client
        ]);
    }

    public function delete($id)
    {
        $client = Cliente::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        $client->delete();
        return response()->json(['message' => 'Cliente eliminado exitosamente']);
    }
}
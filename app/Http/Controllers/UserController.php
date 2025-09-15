<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'rut'      => 'required|string|unique:users',
            'lastname' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $nombre = trim(mb_strtolower($request->name));
        $apellido = trim(mb_strtolower($request->lastname));

        $nombre = strtr($nombre, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n']);
        $apellido = strtr($apellido, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n']);

        $email = $nombre . '.' . $apellido . '@ventasfix.cl';

        $user = User::create([
            'name'     => $request->name,
            'email'    => $email,
            'password' => Hash::make($request->password),
            'rut'      => $request->rut,
            'lastname' => $request->lastname,
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user'    => $user
        ], JsonResponse::HTTP_CREATED);
    }

    public function list()
    {
        return response()->json(User::paginate(10));
    }

    public function get($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado exitosamente'], JsonResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|min:6',
            'rut'      => 'sometimes|required|string|unique:users,rut,' . $id,
            'lastname' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('lastname')) {
            $user->lastname = $request->lastname;
        }
        if ($request->has('rut')) {
            $user->rut = $request->rut;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // Regenerar email institucional si se modificó nombre o apellido
        if ($request->has('name') || $request->has('lastname')) {
            $nombre = trim(mb_strtolower($user->name));
            $apellido = trim(mb_strtolower($user->lastname));
            $nombre = strtr($nombre, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n']);
            $apellido = strtr($apellido, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n']);
            $user->email = $nombre . '.' . $apellido . '@ventasfix.cl';
        }

        $user->save();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'user'    => $user
        ], JsonResponse::HTTP_OK);
    }
}
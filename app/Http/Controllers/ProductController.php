<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|unique:productos',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'required|integer',
            'stock_actual' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_bajo' => 'boolean',
            'stock_alto' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $precio_venta = intval($request->precio_neto * 1.19);

        $product = Producto::create([
            'sku' => $request->sku,
            'nombre' => $request->nombre,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_larga' => $request->descripcion_larga,
            'imagen_url' => $request->imagen_url,
            'precio_neto' => $request->precio_neto,
            'precio_venta' => $precio_venta,
            'stock_actual' => $request->stock_actual,
            'stock_minimo' => $request->stock_minimo,
            'stock_bajo' => $request->stock_bajo ?? false,
            'stock_alto' => $request->stock_alto,
        ]);

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'product' => $product
        ], JsonResponse::HTTP_CREATED);
    }

    public function list()
    {
        return response()->json(Producto::paginate(10));
    }

    public function get($id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'sku' => 'string|unique:productos,sku,' . $id,
            'nombre' => 'string|max:255',
            'descripcion_corta' => 'string|max:255',
            'descripcion_larga' => 'string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'integer',
            'stock_actual' => 'integer',
            'stock_minimo' => 'integer',
            'stock_bajo' => 'boolean',
            'stock_alto' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->only([
            'sku',
            'nombre',
            'descripcion_corta',
            'descripcion_larga',
            'imagen_url',
            'precio_neto',
            'stock_actual',
            'stock_minimo',
            'stock_bajo',
            'stock_alto'
        ]);

        if (isset($data['precio_neto'])) {
            $data['precio_venta'] = intval($data['precio_neto'] * 1.19);
        }

        $product->update($data);

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'product' => $product
        ]);
    }

    public function delete($id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
        $product->delete();
        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}







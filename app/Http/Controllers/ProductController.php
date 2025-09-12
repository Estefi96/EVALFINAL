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
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], jsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json([
            'message' => 'Producto creado exitosamente',
            'product'    => Producto::create([
                'sku' => $request->sku,
                'nombre' => $request->nombre,
                'descripcion_corta' => $request->descripcion_corta,
                'descripcion_larga' => $request->descripcion_larga,
                'imagen_url' => $request->imagen_url,
                'precio_neto' => $request->precio_neto,
                'precio_venta' => ($request->precio_neto * 0.19) + $request->precio_neto,
                'stock_actual' => $request->stock_actual,
                'stock_minimo' => $request->stock_minimo,
                'stock_bajo' => $request->stock_bajo ?? false,
            ])
        ], JsonResponse::HTTP_CREATED);
    }
    public function list()
    {
        $products = Producto::all();
        return response()->json($products);
    }

    public function get($id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'sku' => 'string|unique:productos,sku,' . $id,
            'nombre' => 'string|max:255',
            'descripcion_corta' => 'string|max:255',
            'descripcion_larga' => 'string',
            'imagen_url' => 'nullable|url',
            'precio_neto' => 'integer',
            'precio_venta' => 'integer',
            'stock_actual' => 'integer',
            'stock_minimo' => 'integer',
            'stock_bajo' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product->update($request->only([
            'sku',
            'nombre',
            'descripcion_corta',
            'descripcion_larga',
            'imagen_url',
            'precio_neto',
            'precio_venta',
            'stock_actual',
            'stock_minimo',
            'stock_bajo'
        ]));

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'product' => $product
        ]);
    }

    public function delete($id)
    {
        $product = Producto::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
}









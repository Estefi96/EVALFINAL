<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductWebController extends Controller
{
    public function index()
    {
        $products = Producto::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $precio_venta = intval($request->precio_neto * 1.19);

        Producto::create([
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

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente');
    }

    public function edit($id)
    {
        $product = Producto::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Producto::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|unique:productos,sku,' . $id,
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->update([
            'sku' => $request->sku,
            'nombre' => $request->nombre,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_larga' => $request->descripcion_larga,
            'imagen_url' => $request->imagen_url,
            'precio_neto' => $request->precio_neto,
            'precio_venta' => intval($request->precio_neto * 1.19),
            'stock_actual' => $request->stock_actual,
            'stock_minimo' => $request->stock_minimo,
            'stock_bajo' => $request->stock_bajo ?? false,
            'stock_alto' => $request->stock_alto,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $product = Producto::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
    }
}
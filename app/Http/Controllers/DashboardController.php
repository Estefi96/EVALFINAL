<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalUsers'    => User::count(),
            'totalProducts' => Producto::count(),
            'totalClients'  => Cliente::count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacacionController extends Controller
{
    public function index()
    {
        // listar vacaciones del usuario autenticado
        return Vacacion::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'nullable|string',
        ]);

        $vacacion = Vacacion::create([
            'user_id' => Auth::id(),
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'motivo' => $request->motivo,
        ]);

        return response()->json($vacacion, 201);
    }
}
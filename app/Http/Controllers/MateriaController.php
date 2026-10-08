<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::orderBy('nombre')->get();
        return view('materias.mostrar', compact('materias'));
    }

    public function create()
    {
        return view('materias.registrar');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'clave'    => 'required|string|max:20|unique:materias,clave',
            'nombre'   => 'required|string|max:100',
            'creditos' => 'required|integer|min:1|max:20',
            'semestre' => 'required|integer|min:1|max:10',
        ]);

        Materia::create($datos);

        return redirect('/materias')->with('success', 'Materia registrada correctamente.');
    }

    public function eliminar()
    {
        $materias = Materia::orderBy('nombre')->get();
        return view('materias.eliminar', compact('materias'));
    }

    public function destroy($id)
    {
        Materia::findOrFail($id)->delete();

        return redirect('/materias')->with('success', 'Materia eliminada correctamente.');
    }
}

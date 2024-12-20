<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Role;
use App\Models\User;
use App\Models\user_role;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::with('user')->get();

        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::where('nombre', 'Jefe departamento')->first();
        $usuarios = user_role::with('user')->where('role_id', $role->id)->get();

        return view('departamentos.create', compact('usuarios'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'jefe_departamento' => 'required',
        ]);
        $departamento = new Departamento();
        $departamento->nombre = $request->nombre;
        $departamento->user_id = $request->jefe_departamento;

        $departamento ->save();

        return redirect(route('departamentos.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departamento = Departamento::find($id);
        //$cursos = Curso::where('departamento_id', $id)->get();

        //return view('departamentos.show', compact('cursos', 'departamento'));
        return view('departamentos.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        $role = Role::where('nombre', 'Jefe departamento')->first();
        $usuarios = user_role::with('user')->where('role_id', $role->id)->get();

        return view('departamentos.edit', compact('departamento', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'nombre' => 'required|string',
            'jefe_departamento' => 'required',
        ]);
        $departamento->nombre = $request->nombre;
        $departamento->user_id = $request->jefe_departamento;

        $departamento ->save();

        return redirect(route('departamentos.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        return redirect(route('departamentos.index'));
    }
}

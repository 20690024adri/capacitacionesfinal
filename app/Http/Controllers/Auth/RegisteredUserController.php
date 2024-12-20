<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Datos_generale;
use App\Models\Departamento;
use App\Models\Instructore;
use App\Models\Participante;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        $departamentos = Departamento::all();
        return view('auth.register', compact('departamentos', 'roles'));

    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['nullable', 'string', 'max:255'],
            'apellido_materno' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'departamento' => ['required', 'int'],
            'roles' => ['array'],
            'roles.*' => ['int', 'exists:roles,id'],
            'tipo_usuario' => ['required'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo_usuario
        ]);

        Datos_generale::create([
            'user_id' => $user->id,
            'departamento_id' => $request->departamento,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
        ]);

        // Adjuntar múltiples roles en la tabla pivote
        $user->user_roles()->attach($request->roles, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $instructorRoleId = Role::where('nombre', 'instructor')->first()->id;

        $roleIds = $request->roles ?? [];

        if (in_array($instructorRoleId, $roleIds)) {
            Instructore::create([
                'user_id' => $user->id,
            ]);
        }
        Participante::create([
            'user_id' => $user->id
        ]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);

    }
}

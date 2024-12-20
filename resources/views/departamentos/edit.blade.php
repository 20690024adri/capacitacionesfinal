<x-app-layout>
    <!-- Agregar Bootstrap CSS -->
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                /* Quitar el subrayado de todos los enlaces */
                a {
                    text-decoration: none !important;
                }
            </style>
        </head>

    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            {{ __('Editar departamento:') }} {{$departamento->nombre}}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col  items-center pt-6  bg-gray-100">
        <form action="{{ route('departamentos.update', ['departamento' => $departamento]) }}" method="POST"
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @csrf
            @method('PATCH')
            <!-- Nombre -->
            <div class="mt-4">
                <x-input-label for="nombre" value="Nombre" />
                <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" value="{{ $departamento->nombre }}"/>
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>
            <!-- Trimestre -->
            <div class="mt-4">
                <x-input-label for="jefe_departamento" value="Jefe Departamento" />
                <select name="jefe_departamento" id="jefe_departamento"
                        class="block mt-1 w-full border-black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($usuarios as $usuario)
                        <option value="{{$usuario->user->id}}" {{ $departamento->user_id == $usuario->user->id ? 'selected' : '' }}>
                            {{$usuario->user->datos_generales->nombre}} {{$usuario->user->datos_generales->apellido_paterno}} {{$usuario->user->datos_generales->apellido_materno}}
                        </option>
                        @endforeach
                </select>
            </div>

            <x-primary-button class="mt-4">Editar</x-primary-button>
        </form>
    </div>
</x-app-layout>

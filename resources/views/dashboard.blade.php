<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary text-black mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                        Agregar nuevo mueble
                    </button>
                    @if (session('success'))
                    <h6 class="alert alert-success" id="success-message">{{ session('success') }}</h6>
                    @endif
                    @if (session('error'))
                    <h6 class="alert alert-danger">{{ session('error') }}</h6>
                    @endif
                    <div class="modal" id="myModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar nuevo Mueble</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/muebles">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nombre Mueble: </label>
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción Mueble: </label>
                                            <input type="text" class="form-control" id="description" name="description">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-black" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary text-black">Crear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="ml-4 mb-4 fs-3">Listado de Muebles</label>
                    <table class="table mx-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Descripción</th>
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($muebles as $mueble)
                            <tr>
                                <td class="border px-4 py-2">{{ $mueble->id }}</td>
                                <td class="border px-4 py-2">{{ $mueble->nombre }}</td>
                                <td class="border px-4 py-2">{{ $mueble->description }}</td>
                                <td class="border px-4 py-2">{{ $mueble->estado ? 'Terminado' : 'En Progeso' }}</td>
                                <td class="border px-4 py-2">$ {{ $mueble->price}}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{route('editarMueble', ['mueble' => $mueble]) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{route('muebles.destroy', [$mueble->id]) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.x', () => {
        myInput.focus()
    })
</script>
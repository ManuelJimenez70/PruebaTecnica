<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materiales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary text-black mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                        Agregar nuevo material
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
                                    <h5 class="modal-title">Agregar nuevo Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/materiales">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nombre Material: </label>
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio Material: </label>
                                            <input type="text" class="form-control" id="valor" name="valor">
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

                <div class="text-gray-900 mt-4">
                    <label class="ml-4 mb-4 fs-3">Listado de Materiales</label>
                    <table class="table mx-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiales as $material)
                            <tr>
                                <td class="border px-4 py-2">{{ $material->id }}</td>
                                <td class="border px-4 py-2">
                                    {{ $material->nombre }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $material->valor }}
                                </td>
                                <td class="border px-4 py-2">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal2_{{ $material->id }}">Editar</button>
                                    <div class="modal" id="myModal2_{{ $material->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Material</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('materiales.update', [$material->id])}}" method="POST">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Nombre Material: </label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$material -> nombre}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Precio Material: </label>
                                                            <input type="text" class="form-control" id="valor" name="valor" value="{{$material -> valor}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary text-black" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary text-black">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('materiales.destroy', [$material->id])}}" method="POST" class="d-inline">
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

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })

        @foreach ($materiales as $material)
        const myModal2_{{ $material->id }} = document.getElementById('myModal2_{{ $material->id }}')
        const myInput2_{{ $material->id }} = document.getElementById('myInput2_{{ $material->id }}')

        myModal2_{{ $material->id }}.addEventListener('shown.bs.modal', () => {
            myInput2_{{ $material->id }}.focus();
        })
        @endforeach
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Mueble') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{route('muebles.update', [$mueble->id])}}">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre Mueble: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$mueble->nombre}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción Mueble: </label>
                            <input type="text" class="form-control" id="description" name="description" value="{{$mueble->description}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado Mueble: </label>
                            <select class="form-select" aria-label="Default select example" name="estado">
                                <option value="0" {{ $mueble->estado == 0 ? 'selected' : '' }}>En Progreso...</option>
                                <option value="1" {{ $mueble->estado == 1 ? 'selected' : '' }}>Terminado</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary text-black h-full">Editar</button>
                            @if (session('success'))
                            <h6 class="alert alert-success ml-4" id="success-message">{{ session('success') }}</h6>
                            @endif
                            @if (session('error'))
                            <h6 class="alert alert-danger ml-4">{{ session('error') }}</h6>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4">

                <div class="mt-4">
                    <label class="ml-4 mb-4 fs-3">Listado de Materiales Asignados</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materialesAsignados as $material)
                            <tr>
                                <td class="border px-4 py-2">{{ $material->id }}</td>
                                <td class="border px-4 py-2" data-material="{{ $material->id }}">
                                    {{ $material->nombre }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $material->valor }}
                                </td>
                                <td class="border py-2">
                                    <form action="{{route('mueble_material.destroy', [$material->id])}}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                    <div class="">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4">

                <div class="mt-4">
                    <label class="ml-4 mb-4 fs-3">Listado de Materiales</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiales as $material)
                            <tr>
                                <td class="border px-4 py-2">{{ $material->id }}</td>
                                <td class="border px-4 py-2" data-material="{{ $material->id }}">
                                    {{ $material->nombre }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $material->valor }}
                                </td>
                                <td class="border py-2">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal2_{{ $material->id }}">Asignar Material</button>
                                    <div class="modal" id="myModal2_{{ $material->id }}" tabindex="-1" data-material="{{$material}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Asignar Material: {{$mueble->nombre}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('mueble_material.store')}}" method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Id Mueble: </label>
                                                            <input type="text" class="form-control" id="mueble_id" name="mueble_id" value="{{$mueble -> id}}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Id Material: </label>
                                                            <input type="text" class="form-control" id="material_id" name="material_id" value="{{$material -> id}}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nombre Material: </label>
                                                            <input type="text" class="form-control" id="nombreMaterial" name="nombreMaterial" value="{{$material -> nombre}}" readonly>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Cantidad Material: </label>
                                                            <input type="text" class="form-control" id="cantidad" name="cantidad">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary text-black" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary text-black">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

    @foreach($materiales as $material)
    const myModal2_ {
        {
            $material - > id
        }
    } = document.getElementById('myModal2_{{ $material->id }}')
    const myInput2_ {
        {
            $material - > id
        }
    } = document.getElementById('myInput2_{{ $material->id }}')

    myModal2_ {
        {
            $material - > id
        }
    }.addEventListener('shown.bs.modal', () => {
        myInput2_ {
            {
                $material - > id
            }
        }.focus();
    })
    @endforeach
    setTimeout(function() {
        document.getElementById('success-message').style.opacity = '0';
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 1000);
    }, 3000);
</script>
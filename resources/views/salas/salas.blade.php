@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <button type="button" class="btn btn-info btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#salas">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="salas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva salas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Salas-store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control" placeholder="Tipo de sala" name="tipo_sala"
                                    required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <select class="form-select" aria-label="Default select example" name="personal" required>
                                    @foreach ($personals as $personal)
                                        <option value="{{ $personal->id }}">{{ $personal->nombres }}
                                            {{ $personal->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-info btn-xs mt-2">Guardar</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <p>Welcome to this beautiful admin panel.</p>
    <table class="table table-striped">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Personal a Cargo</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <p class="mb-0 text-sm">{{ $sala->id }}</p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $sala->nombre }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"> {{ $sala->personals_id }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">  {{ $sala->estado == 1 ? 'Activo' : 'Inactivo' }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $sala->created_at}}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex gap-2">

                            <a href="{{ route('Salas-editar', $sala->id) }}" class="btn btn-info btn-sm mr-1">Edit</a>

                            <form action="" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar este elemento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach



        </tbody>
    </table>

    <div class="d-flex">
        {{-- {{ $salas->links() }} --}}
    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@stop

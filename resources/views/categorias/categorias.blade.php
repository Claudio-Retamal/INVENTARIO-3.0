@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')

    <small class="btn btn-warning btn-sm mt-2">

        <a href="{{ asset('categorias.xlsx') }}">Excel Base</a>

    </small>
    <small class="btn btn-warning btn-sm mt-2"> <i class="fas fa-light fa-arrow-left "></i><span class="ml-1 ">Descargar excel
            pra carga masiva</span> </small>

    <div class="row mt-2">
        <form action="{{ route('Categorias-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="file" id="file" class="form-control"
                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-outline-secondary" type="submit" id="id">Masivo</button>

            </div>
        </form>
    </div>

    <button type="button" class="btn btn-secondary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#categorias">
        Agregar Categoria
    </button>

    <!-- Modal -->
    <div class="modal fade" id="categorias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Categorias-store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Descripcion" name="descripcion"
                                    required>
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

    <table class="table table-striped mt-1" id="categorias">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <p class="mb-0 text-sm">{{ $categoria->id }}</p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $categoria->nombre }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $categoria->descripcion }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">

                                @if ($categoria->estado == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif

                            </h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex gap-2">

                            <a href="{{ route('Categorias-editar', $categoria->id) }}"
                                class="btn btn-info btn-sm mr-1">Edit</a>

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
        {{ $categorias->links() }}
    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
@stop

@section('js')
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

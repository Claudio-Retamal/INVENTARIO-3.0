@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
    <small class="btn btn-warning btn-sm mt-2">
        <a href="{{ asset('personal.xlsx') }}">Excel Base</a>

    </small>
    <small class="btn btn-warning btn-sm mt-2"> <i class="fas fa-light fa-arrow-left "></i><span class="ml-1 ">Descargar excel
            pra carga masiva</span> </small>



    <div class="row mt-2">
        <form action="{{ route('Personal-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="file" id="file" class="form-control"
                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-outline-secondary" type="submit" id="id">Masivo</button>

            </div>
        </form>
    </div>

    <button type="button" class="btn btn-info btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#personals">
        Agregar Personal
    </button>


    <button type="button" class="btn btn-info btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#add_cargo">
        Agregar Cargo
    </button>

    <div class="modal fade" id="add_cargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Cargo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('Cargo-store') }}" method="POST" id="cargo_add"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="equipos">Ingrese cargo</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="nuevo_cargo" name="cargo_nuevo"
                                            placeholder="Ingrese titulo" aria-label="Recipient's username">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" id="id">Guardar</button>

                        </form>
                    </div>

                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="editar">Editar</button>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="eliminar">Eliminar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="personals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva personal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Personal-store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombres" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Descripcion" name="apellidos"
                                    required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select name="cargo" id="cargo" class="form-select">
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
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

    <table class="table table-striped mt-1" id="personals">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Cargo</th>

                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personals as $personal)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <p class="mb-0 text-sm">{{ $personal->id }}</p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $personal->nombres }}</h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $personal->apellidos }}</h6>

                        </div>
                    </td>

                    <td>



                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                                <h6 class="mb-0 text-sm">

                                    @foreach ($cargos_personal as $cargo_personal)
                                        @if ($personal->cargos_id == $cargo_personal->id)
                                            {{ $cargo_personal->nombre }}
                                        @endif
                                    @endforeach
                                </h6>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                                @if ($personal->estado == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </h6>

                        </div>
                    </td>

                    <td>
                        <div class="d-flex gap-2">

                            <a href="{{ route('Personal-editar', $personal->id) }}"
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
        {{ $personals->links() }}
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
            @endif ;




        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@stop

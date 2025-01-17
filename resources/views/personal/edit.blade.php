@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')

    <div class="container">


        <div class="card p-2 mt-2">

            @foreach ($personal as $persona)
                <div class="row mt-2">
                    <form action="{{ route('Personal-update', $persona->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $persona->nombres }}"
                                    placeholder="Nombre" name="nombres" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $persona->apellidos }}"
                                    placeholder="Descripcion" name="apellidos" required>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col">
                                <select name="cargo" class="form-control">
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}"
                                            {{ $cargo->id == $persona->cargos_id ? 'selected' : '' }}>
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select name="estado" class="form-control">

                                    <option value="1" {{ $persona->estado == 1 ? 'selected' : '' }}>
                                        Activo
                                    </option>
                                    <option value="0" {{ $persona->estado == 0 ? 'selected' : '' }}>
                                        Inactivo
                                    </option>

                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-info btn-sm mt-2" data-bs-toggle="modal"
                            data-bs-target="#personals">
                            editar Personal
                        </button>
                    </form>
                </div>
            @endforeach

        </div>
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

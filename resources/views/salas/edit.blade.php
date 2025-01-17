@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')

    <div class="container">
        <div class="card p-2 mt-2">
            <div class="row mt-2">
                <form action="{{ route('Salas-update', $salas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $salas->nombre }}" placeholder="Nombre"
                                name="nombres" required>
                        </div>


                        <div class="col">
                            <input type="text" class="form-control" value="{{ $salas->tipo_sala }}"
                                placeholder="Descripcion" name="apellidos" required>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="category">Selecciona una categoría</label>
                            <select name="categorias_id" id="categoria" class="form-control">
                                @foreach ($personals as $personal)
                                    <option value="{{ $personal->id }}">{{ $personal->nombres }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="category">Selecciona una categoría</label>
                            <select name="categorias_id" id="categoria" class="form-control">
                                @foreach ($personals as $personal)
                                    <option value="{{ $personal->id }}">{{ $personal->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="category">Selecciona estado</label>
                            <select name="estado" class="form-control">

                                <option value="1" {{ $salas->estado == 1 ? 'selected' : '' }}>
                                    Activo
                                </option>
                                <option value="0" {{ $salas->estado == 0 ? 'selected' : '' }}>
                                    Inactivo
                                </option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="category">Selecciona estado</label>
                            <br>
                            <button type="submit" class="btn btn-info">editar Personal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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

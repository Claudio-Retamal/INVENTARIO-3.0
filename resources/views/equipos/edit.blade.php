@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="col-12"><a href="{{ route('Equipos') }}"
            class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fa-2x"><i
                class="fas fa-backward success" aria-hidden="true"></i></a>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-6">
                <h3>Editar Equipo</h3>
            </div>

        </div>

    </div>
@stop

@section('content')



    <div class="card" style="width: 100%;">
        <div class="card-body">
            <form action="{{route('Equipos.update', $equipos->id)  }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="formGroupExampleInput"
                                    placeholder="Example input" value="{{ $equipos->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Serial</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="serial"
                                    placeholder="Another input" value="{{ $equipos->serial }}">
                            </div>


                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Modelo</label>
                                <input type="text" class="form-control" name="modelo" id="formGroupExampleInput"
                                    placeholder="Example input" value="{{ $equipos->modelo }}">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Color</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="color"
                                    placeholder="Another input" value="{{ $equipos->color }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Estado</label>

                                <select name="estado" id="estado" class="form-control">
                                    <option value="" {{ old('estado', $equipos->estado) === null ? 'selected' : '' }}>
                                        Seleccionar...
                                    </option>
                                    <option value="1" {{ old('estado', $equipos->estado) == 1 ? 'selected' : '' }}>
                                        Activo</option>
                                    <option value="0" {{ old('estado', $equipos->estado) == 0 ? 'selected' : '' }}>
                                        Inactivo</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <label for="category">Seleccione sala</label>
                            <select name="salas_id" id="sala" class="form-control">
                                @foreach ($salas as $sala)
                                    <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="category">Selecciona una categoría</label>
                            <select name="categorias_id" id="categoria" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label for="formGroupExampleInput">Fecha de creación</label>
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
        </div>

        </form>
    </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop

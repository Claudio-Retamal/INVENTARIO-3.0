@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="col-12"><a href="{{ route('Categorias') }}"
            class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fa-2x"><i
                class="fas fa-backward success" aria-hidden="true"></i></a>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-6">
                <h3>Editar Categoria</h3>
            </div>

        </div>

    </div>
@stop

@section('content')

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <form action="{{ route('Categorias.update', $categorias->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="formGroupExampleInput"
                                    placeholder="Example input" value="{{ $categorias->nombre }}">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Another label</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="descripcion"
                                    placeholder="Another input" value="{{ $categorias->descripcion }}">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Example label</label>

                                <select name="estado" id="estado" class="form-control">
                                    <option value=""
                                        {{ old('estado', $categorias->estado) === null ? 'selected' : '' }}>
                                        Seleccionar...
                                    </option>
                                    <option value="1" {{ old('estado', $categorias->estado) == 1 ? 'selected' : '' }}>
                                        Activo</option>
                                    <option value="0" {{ old('estado', $categorias->estado) == 0 ? 'selected' : '' }}>
                                        Inactivo</option>
                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Actualizar Categoria</label>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
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

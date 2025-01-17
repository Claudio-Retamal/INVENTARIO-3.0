@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>



    <!-- Modal -->
    <div class="modal fade" id="prestacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="" id="form_data" enctype="multipart/form-data">
                            @csrf


                            <div class="row mt-2">
                                <div class="col">
                                    <label for="equipos">Ingrese titulo</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Ingrese titulo" aria-label="Recipient's username">

                                    </div>
                                </div>

                            </div>



                            <div class="row
                            mt-2">

                                <input type="hidden" name="id">
                                <div class="col">
                                    <label for="equipos">Selecciona equipo para prestacion</label><br>
                                    <div class="container">
                                        <small class="bg-info">NOMBRE</small><small
                                            class="bg-secondary">MODELO</small><small class="bg-primary">SERIAL</small>

                                    </div>

                                    <select name="equipo" id="equipo" class="form-select">
                                        @foreach ($equipos as $equipo)

                                            <option value="{{ $equipo->id }}">
                                                {{ $equipo->nombre }}-{{ $equipo->modelo }}-{{ $equipo->serial }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label for="category">Seleccione personal solicitante</label>
                                    <select name="personal" id="personal" class="form-select">
                                        @foreach ($personals as $personal)
                                            <option value="{{ $personal->id }}">{{ $personal->nombres }}
                                                {{ $personal->apellidos }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="start">Fecha de Inicio</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="date" class="form-control" placeholder="Username"
                                            aria-label="Username" id="start" aria-describedby="basic-addon1"
                                            name="start">
                                    </div>

                                </div>


                                <div class="col-6">
                                    <label for="end">Fecha de entrega</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="date" class="form-control" placeholder="Username"
                                            aria-label="Username" aria-describedby="basic-addon1" id="end"
                                            name="end">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="end">Color</label>
                                    <div class="input-group mb-3">

                                        <input type="color" class="form-control" placeholder="Username"
                                            aria-label="Username" aria-describedby="basic-addon1" name="color"
                                            id="color">
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="end">Observación</label>
                                    <div class="input-group mb-3">

                                        <textarea name="observacion" id="observacion" cols="5" class="form-control" rows="5"></textarea>

                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_guardar" class="btn btn-info btn-xs mt-2"
                        id="btn_guardar">Guardar</button>


                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="editar">Editar</button>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        id="eliminar">Eliminar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <div id='calendar'></div>
    <div class="d-flex">

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

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let form_data = document.getElementById("form_data");
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locales: 'ES',
                hiddenDays: [0, 6],
                events: "{{ route('Prestacion-show') }}",

                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek'
                },

                views: {
                    dayGridMonth: { // name of view
                        titleFormat: {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }
                    }
                },

                dateClick: function(info) {
                    form_data.reset();
                    form_data.start.value = info.dateStr;
                    $("#prestacion").modal("show");

                },

                eventClick: function(info) {

                    let events = info.event;

                    $.ajax({
                        url: '/Prestacion-editar/' + events.id,
                        type: "GET", // Método HTTP

                        success: function(response) {
                            // Mostrar la respuesta en la página
                            calendar.refetchEvents();
                            form_data.id.value = response.id;
                            form_data.title.value = response.title;
                            form_data.equipo.value = response.equipos_id;
                            form_data.personal.value = response.personals_id;
                            form_data.start.value = response.start;
                            form_data.end.value = response.end;
                            form_data.color.value = response.color;
                            form_data.observacion.value = response.observacion;

                        },

                        error: function(xhr, status, error) {
                            // Mostrar errores si ocurren
                            $("#resultado").html(
                                `<div class="alert alert-danger">Ocurrió un error: ${xhr.responseJSON?.message || error}</div>`
                            );
                        },

                    });

                    document.getElementById("editar").addEventListener("click", function() {

                        let id = events.id;

                        let  title = $('#title').val(); 
                        let  start = $('#start').val(); 
                        let  end = $('#end').val(); 
                        let  color = $('#color').val(); 
                        let  observacion = $('#observacion').val(); 
                        let  equipos = $('#equipo').val(); 
                        let   personal = $('#personal').val(); 

                        $.ajax({
                            url: '/Prestacion_update/' + id,
                            type: 'PUT',
                            data: {
                                 title:title,
                                 start:start,
                                 end:end,
                                 color:color,
                                 observacion:observacion,
                                 equipo:equipo,
                                 personal:personal,
                                _token: '{{ csrf_token() }}' // Agregar el token CSRF para proteger la solicitud
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Usuario actualizado con éxito');
                                    // Aquí puedes actualizar la interfaz o hacer algo más con la respuesta
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON.errors;
                                if (errors) {
                                    // Muestra los errores de validación
                                    alert('Hubo un error: ' + JSON.stringify(
                                        errors));
                                } else {
                                    alert('Error al actualizar el usuario');
                                }
                            }
                        });

                    
                    });


                    $("#prestacion").modal("show");
                },
            })

            calendar.render();



            document.getElementById("btn_guardar").addEventListener("click", function() {
                    const data = new FormData(form_data);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: "{{ route('Prestacion_store') }}", // Ruta definida en Laravel
                        method: "POST", // Método HTTP
                        data: data, // Datos a enviar
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function(response) {
                            // Mostrar la respuesta en la página
                            calendar.refetchEvents();
                            $("#prestacion").modal("hide");
                            // location.reload();

                        },

                        error: function(xhr, status, error) {
                            // Mostrar errores si ocurren
                            $("#resultado").html(
                                `<div class="alert alert-danger">Ocurrió un error: ${xhr.responseJSON?.message || error}</div>`
                            );
                        },
                    });

                }),


                document.getElementById("eliminar").addEventListener("click", function() {
                    // Confirmar antes de eliminar
                    const id = form_data.id.value;
                    if (confirm("¿Estás seguro de que deseas eliminar este post?")) {
                        // Enviar la solicitud AJAX para eliminar el post
                        $.ajax({
                            url: '/Prestacion_delete/' + id, // Ruta del controlador
                            type: 'GET', // Método DELETE
                            data: {
                                "_token": "{{ csrf_token() }}" // Agregar el token CSRF
                            },

                            success: function(response) {
                                // Eliminar el elemento de la interfaz si la eliminación fue exitosa

                                alert(response.success); // Mostrar un mensaje de éxito
                                $("#prestacion").modal("hide");
                                location.reload();
                            },
                            error: function(xhr) {
                                // Mostrar un mensaje de error si la solicitud falla
                                alert(xhr.responseJSON.error ||
                                    'Hubo un error al eliminar el item.');
                            }
                        });
                    }

                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stop

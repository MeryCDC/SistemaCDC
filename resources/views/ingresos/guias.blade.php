@extends('layouts.master')
@section('css')
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <h3 class="nav-link">Guias</h3>
                            </li>
                            <li class="nav-item">
                                <h3 class="nav-link">Codigo de ingreso #: {{ $id }}</h3>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="{{ url('ingresos/' . $id . '/export-excel') }}"
                                    class="btn btn-primary text-white me-0"><i class="icon-download"></i>Exportar</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <form action="{{ url('/entradas') }}" class="form-inline needs-validation" id="formGuias" method="POST" novalidate>
                                    @csrf
                                    <div class="form-group form-row align-items-center">
                                        <div class="col-auto">
                                            <label>Tracking/Perteneciente</label>
                                            <input type="text" class="form-control" name="tgp" id="tgp" autofocus>
                                            <input type="hidden" name="id_importacion" id="id_importacion"
                                                value="{{ $id }}">
                                            <input type="hidden" id="user_id" name="user_id"
                                                value=" {{ Auth::user()->id }}">
                                        </div>
                                        <div class="col-auto">
                                            <label>Peso *</label>
                                            <input type="number" step="any" name="peso" id="peso" class="form-control"
                                                required />
                                            <div class="invalid-feedback">
                                                Ingrese el peso
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <label>Alto *</label> 
                                            <input type="number" step="any" name="alto" id="alto" class="form-control"
                                                required />
                                            <div class="invalid-feedback">
                                                Ingrese el alto
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <label>Largo *</label>
                                            <input type="number" step="any" name="largo" id="largo" class="form-control"
                                                required />
                                            <div class="invalid-feedback">
                                                Ingrese el largo
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <label>Ancho *</label>
                                            <input type="number" step="any" name="ancho" id="ancho" class="form-control"
                                                required />
                                            <div class="invalid-feedback">
                                                Ingrese el ancho
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <br>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="tipo_paquete" id="tipo_paquete"
                                                    class="form-check-input">
                                                Comercial
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <br>
                                            <button class="btn btn-primary">Ingresar</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <div>

                        </div>
                    </div>

                    {{-- <div class="col-md-12">
                        <form action="{{ url('/entradas') }}" class="form-inline needs-validation" id="formGuias"
                            method="POST" novalidate>
                            @csrf
                            <div class="form-group form-row align-items-center">
                                <div class="col-auto">
                                    <label>Tracking/Perteneciente</label>
                                    <input type="text" class="form-control" name="tgp" id="tgp" autofocus>
                                    <input type="hidden" name="id_importacion" id="id_importacion"
                                        value="{{ $id }}">
                                    <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                                </div>
                                <div class="col-auto">
                                    <label>Peso *</label>
                                    <input type="number" step="any" name="peso" id="peso" class="form-control" required />
                                    <div class="invalid-feedback">
                                        Ingrese el peso
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label>Alto *</label>
                                    <input type="number" step="any" name="alto" id="alto" class="form-control" required />
                                    <div class="invalid-feedback">
                                        Ingrese el alto
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label>Largo *</label>
                                    <input type="number" step="any" name="largo" id="largo" class="form-control"
                                        required />
                                    <div class="invalid-feedback">
                                        Ingrese el largo
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label>Ancho *</label>
                                    <input type="number" step="any" name="ancho" id="ancho" class="form-control"
                                        required />
                                    <div class="invalid-feedback">
                                        Ingrese el ancho
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <br>
                                    <label class="form-check-label">
                                        <input type="checkbox" name="tipo_paquete" id="tipo_paquete"
                                            class="form-check-input">
                                        Comercial
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <br>
                                    <button class="btn btn-primary">Ingresar</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}

                    
                    {{-- Tabla de guias --}}
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="filter_global">
                                                <td>Busqueda Global</td>
                                                <td><input type="text" class="global_filter form-control"
                                                        id="global_filter"></td>
                                            </tr>
                                            <tr id="filter_col1" data-column="0">
                                                <td>Busqueda ID</td>
                                                <td><input type="text" class="column_filter form-control" id="col0_filter">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="tabla_guias" class="table dt-responsive table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:15px">ID</th>
                                                <th>T/G/P</th>
                                                <th>ID CDC</th>
                                                <th>Alto</th>
                                                <th>Largo</th>
                                                <th>Ancho</th>
                                                <th>Peso</th>
                                                <th>Tipo</th>
                                                <th>Peso volumetrico</th>
                                                <th>Volumen</th>
                                                <th>Ingreso</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach ($guiasImportaciones as $guia)
                                                <tr>
                                                    <td>{{ $guia->id }}</td>
                                                    <td>{{ $guia->tgp }}</td>
                                                    <td>{{ $guia->id_cdc }}</td>
                                                    <td>{{ $guia->alto }}</td>
                                                    <td>{{ $guia->largo }}</td>
                                                    <td>{{ $guia->ancho }}</td>
                                                    <td>{{ $guia->peso }}</td>
                                                    <td>{{ $guia->tipo }}</td>
                                                    <td>{{ number_format($guia->peso_volumetrico, 3) }}</td>
                                                    <td>{{ $guia->volumen }}</td>
                                                    <td>{{ $guia->name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#deleteActividad"
                                                            data-id="{{ $guia->id }}"
                                                            data-nombre="{{ $guia->id }}">
                                                            <i class="ti-trash"></i>Sacar
                                                        </button>
                                                        @if (empty($guia->tgp))
                                                            <a data-href="{{ url('/entradas/' . $guia->id . '/edit') }}"
                                                                id="btnEditar"
                                                                class="editForm btn btn-warning btn-sm">Editar</a>
                                                            <a href="{{ url('/etiqueta/' . $guia->id) }}" target="_blank"
                                                                class="btn btn-info btn-sm">Label</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width:15px">ID</th>
                                                <th>T/G/P</th>
                                                <th>ID CDC</th>
                                                <th>Alto</th>
                                                <th>Largo</th>
                                                <th>Ancho</th>
                                                <th>Peso</th>
                                                <th>Tipo</th>
                                                <th>Peso volumetrico</th>
                                                <th>Volumen</th>
                                                <th>Ingreso</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para agregar eliminar guia del ingreso -->
    <div class="modal fade" id="deleteActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro de sacar la guia del ingreso?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/entradas/' . '1') }}" class="forms-sample" method="post" id="delAct">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="hidden" class="minuta form-control" id="minutas_id" name="minutas_id" readonly>
                        <input type="hidden" id="Estatus" name="Estatus" value="0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Sacar guia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Final modal para eliminar guia del ingreso -->
@endsection

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

    <script>
        /* Modal para sacar una guia del ingreso*/
        $(function() {
            $('#deleteActividad').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var nombre = button.data('nombre')
                var id = button.data('id')
                var modal = $(this)

                action = $('#delAct').attr('action').slice(0, -1);
                action += id;
                $('#delAct').attr('action', action)

                modal.find('.modal-title').text('Sacar "' + nombre + '"')
                modal.find("#id").val(id)
            })
        });

        $(document).ready(function() {
            $(".editForm").click(function() {
                var caracteristicas =
                    "height=850,width=800,scrollTo,resizable=1,scrollbars=1,location=0,left=800";
                var url = $(this).data("href");
                nueva = window.open(url, "popup", caracteristicas);
                return true;
            });
        });

        $(function() {
            $('#tabla_guias').DataTable({
                "dom": 'lrtip',
                "order": [
                    [0, "desc"]
                ],
                "pageLength": 20,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });

        function filterGlobal() {
            $('#tabla_guias').DataTable().search(
                $('#global_filter').val()
            ).draw();
        }

        function filterColumn(i) {
            $('#tabla_guias').DataTable().column(i).search(
                $('#col' + i + '_filter').val()
            ).draw();
        }

        $(document).ready(function() {
            $('#tabla_guias').DataTable();

            $('input.global_filter').on('keyup click', function() {
                filterGlobal();
            });

            $('input.column_filter').on('keyup click', function() {
                filterColumn($(this).parents('tr').attr('data-column'));
            });
        });


        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection

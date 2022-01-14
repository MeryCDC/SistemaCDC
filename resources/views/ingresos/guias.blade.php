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
                                <a href="{{ url('ingresos/'.$id.'/export-excel')}}" class="btn btn-primary text-white me-0"><i class="icon-download"></i>Exportar</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body col-lg-12 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ url('/entradas') }}"" class="  form-inline needs-validation" id="formGuias"
                                method="POST" novalidate>
                                @csrf
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Tracking/Perteneciente</label>
                                        <input type="text" class="form-control" name="tgp" id="tgp" autofocus>
                                        <input type="hidden" name="id_importacion" id="id_importacion"
                                            value="{{ $id }}">
                                        <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                                    </div>
                                    <div class="col">
                                        <label>Peso *</label>
                                        <input type="number" step="any" name="peso" id="peso" class="form-control"
                                            required />
                                        <div class="invalid-feedback">
                                            Ingrese el peso
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Alto *</label>
                                        <input type="number" step="any" name="alto" id="alto" class="form-control"
                                            required />
                                        <div class="invalid-feedback">
                                            Ingrese el alto
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Largo *</label>
                                        <input type="number" step="any" name="largo" id="largo" class="form-control"
                                            required />
                                        <div class="invalid-feedback">
                                            Ingrese el largo
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Ancho *</label>
                                        <input type="number" step="any" name="ancho" id="ancho" class="form-control"
                                            required />
                                        <div class="invalid-feedback">
                                            Ingrese el ancho
                                        </div>
                                    </div>
                                    <div class="col">
                                        <br>
                                        <label class="form-check-label">
                                            <input type="checkbox" name="tipo_paquete" id="tipo_paquete" class="form-check-input">
                                            Comercial
                                        </label>
                                    </div>
                                    <div class="col">
                                        <br>
                                        <button class="btn btn-primary" >Ingresar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
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
                                                    <td>{{ number_format($guia->peso_volumetrico, 2) }}</td>
                                                    <td>{{ $guia->volumen }}</td>
                                                    <td>{{ $guia->name }}</td>
                                                    <td>
                                                        {{-- @can('minutas.mostar.edit') --}}
                                                        <a data-href="{{ url('/entradas/' . $guia->id . '/edit') }}"
                                                            id="btnEditar"
                                                            class="editForm btn btn-warning btn-sm">Editar</a>
                                                        {{-- @endcan --}}
                                                        @if (empty($guia->tgp))
                                                            <a href="{{ url('/etiqueta/' . $guia->id) }}" target="_blank"
                                                                class="btn btn-info btn-sm">Label</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

    <script>
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
                "order": [
                    [0, "desc"]
                ],
                "pageLength": 20,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
        /* Modal para agregar un nuevo ingreso */
        $(function() {
            $('#ingreso').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var minutaid = button.data('id')
                var modal = $(this)
                modal.find('.modal-title').text('Crear nuevo ingreso')
            })
        });

        // 
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

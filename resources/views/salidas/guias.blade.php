@extends('layouts.master')
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
                                <h3 class="nav-link">Codigo de salida #: {{ $id }}</h3>
                            </li>
                        </ul>
                        <div>
                            {{-- <div class="btn-wrapper">
                                <a href="{{ url('ingresos/' . $id . '/export-excel') }}"
                                    class="btn btn-primary text-white me-0"><i class="icon-download"></i>Exportar</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body col-lg-12 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ url('/egresos') }}"" class="    form-inline needs-validation" id="formGuias"
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
                                        <label>Guia Transportadora *</label>
                                        <input type="text" step="any" name="guia_transportadora" id="aguia_transportadora"
                                            class="form-control" required />
                                        <div class="invalid-feedback">
                                            Ingrese el alto
                                        </div>
                                    </div>
                                    {{-- <div class="col">
                        <label>Largo *</label>
                        <input type="number" step="any" name="largo" id="largo" class="form-control" required/>
                        <div class="invalid-feedback">
                            Ingrese el largo
                          </div>
                      </div>
                      <div class="col">
                        <label>Ancho *</label>
                        <input type="number" step="any" name="ancho" id="ancho" class="form-control" required/>
                        <div class="invalid-feedback">
                            Ingrese el ancho
                          </div>
                      </div> --}}
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Salida</button>
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
                                                <th>Fecha</th>
                                                <th style="width:15px">ID</th>
                                                <th>T/G/I</th>
                                                <th>ID CDC</th>
                                                <th>Peso</th>
                                                <th>Diferencia</th>
                                                <th>Transportadora</th>
                                                <th>Salida por</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach ($guiasImportaciones as $guia)
                                                <tr>
                                                    <td>{{ $guia->created_at }}</td>
                                                    <td>{{ $guia->id }}</td>
                                                    <td>{{ $guia->id_cdc }}</td>
                                                    <td>{{ $guia->id_cdc }}</td>
                                                    <td>{{ $guia->peso }}</td>
                                                    <td>{{ $guia->peso }}</td>
                                                    <td>{{ $guia->guia_transportadora }}</td>
                                                    <td>{{ $guia->name }}</td>
                                                    <td>
                                                        <a data-href="{{ url('/entradas/' . $guia->id . '/edit') }}"
                                                            id="btnEditar"
                                                            class="editForm btn btn-warning btn-sm">Editar</a>
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

        @if (Session::has('messageVacio'))
            alert('No puedes dar salida a una guia sin identificar');
        @endif

        @if (Session::has('messageEntrada'))
            alert('No puedes dar salida a una guia sin tener una entrada');
        @endif
    </script>
@endsection

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
                                <h3 class="nav-link">Codigo de ingreso #: {{ $id }}</h3>
                                {{-- <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a> --}}
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                        </li> --}}
                        </ul>
                        <div>
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
                                                    <td>{{ $guia->peso_volumetrico }}</td>
                                                    <td>{{ $guia->volumen }}</td>
                                                    <td>{{ $guia->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width:15px">ID</th>
                                                <th>Totales</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Peso</th>
                                                <th></th>
                                                <th>Peso volumetrico</th>
                                                <th>Volumen</th>
                                                <th></th>
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
@endsection

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

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
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
                    };
                    // Total over all pages
                    total = api.column(6).data().reduce( function (a, b) { return intVal(a) + intVal(b);}, 0 );
                    total1 = api.column(8).data().reduce( function (a, b) { return intVal(a) + intVal(b);}, 0 );
                    total2 = api.column(9).data().reduce( function (a, b) { return intVal(a) + intVal(b);}, 0 );
                    // Total over this page
                    pageTotal = api.column( 6, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                    pageTotal1 = api.column( 8, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                    pageTotal2 = api.column( 9, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );

                    //tipo1 = api.column( 0 ).data().filter( function( a, b) ) {return a == "Paqueteria" ? true: false; };
                    // Update footer
                    $( api.column( 6 ).footer() ).html(pageTotal);
                    $( api.column( 8 ).footer() ).html(pageTotal1);
                    $( api.column( 9 ).footer() ).html(pageTotal2);
                    //$( api.column( 7 ).footer() ).html(tipo1);

                },
                dom: 'Bfrtip', 
                "buttons": [
                    { extend: 'excelHtml5', title: 'ingreso_{{ $id }}' , footer: true},
                    { extend: 'pdfHtml5', title: 'Data export' }
                ],
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

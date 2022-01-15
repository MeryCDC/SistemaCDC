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
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <button class="btn btn-primary text-white me-0">Export</button>
                            </div>
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
                                                    <td>{{ number_format($guia->peso_volumetrico, 3) }}</td>
                                                    <td>{{ $guia->volumen }}</td>
                                                    <td>{{ $guia->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Totales</th>
                                                <th></th>
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
    <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>

    <script src="{{ asset('js/jquery.table2excel.js') }}"></script>

    <script>
        var volumen, peso;
        var intVal = function(i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
        };
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
                "rowGroup": {
                    endRender: function(rows, group) {
                        peso = rows.data().pluck(6).reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        volumen = rows.data().pluck(9).reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        pesoV = rows.data().pluck(8).reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        return $('<tr/>').append(
                            '<td> <b> Totales </b> </td>' +
                            '<td> </td>' +
                            '<td> </td>' +
                            '<td> </td>' +
                            '<td> </td>' +
                            '<td> <b>' + peso + ' </b> </td>' +
                            '<td> </td>' +
                            '<td> </td>' +
                            '<td> <b> ' + pesoV + ' </b> </td>' +
                            '<td> <b> ' + volumen + ' </b> </td>' 
                        );
                    },
                    dataSrc: [7]
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    pesoTotal = api.column(6, {
                        page: 'current'
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    pesoVTotal = api.column(8, {
                        page: 'current'
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    volumenTotal = api.column(9, {
                        page: 'current'
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    $(api.column(6).footer()).html(pesoTotal);
                    $(api.column(8).footer()).html(pesoVTotal);
                    $(api.column(9).footer()).html(volumenTotal);

                },
                "drawCallback": function() {
                    var api = this.api();
                    $(api.column(0).footer()).html(
                        'Total: ' + api.column(7, {
                            page: 'current'
                        }).data().count() + '<br>' +
                        'Paqueteria: ' + api.column(7, {
                            page: 'current'
                        }).data().filter(function(value, index) {
                            return value == 'Paqueteria' ? true : false;
                        }).count() + '<br>' +
                        'Comercial: ' + api.column(7, {
                            page: 'current'
                        }).data().filter(function(value, index) {
                            return value == 'Comercial' ? true : false;
                        }).count() 

                    )
                },
                "order": [
                    [7, "desc"]
                ],
                "pageLength": -1,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });

        $("button").click(function() {
            $('#tabla_guias').table2excel({
                exclude: ".noExl",
                name: "ingreso_{{ $id }}",
                filename: "ingreso_{{ $id }}", 
                fileext: ".xls" 
            });
        });
    </script>
@endsection

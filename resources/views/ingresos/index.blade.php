@extends('layouts.master')

@section('css')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="card-body col-lg-12 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Ingresos a bodega</h2>
                <div class="add-items d-flex mb-0">
                   {{--  @can('minutas.index.store') --}}
                    <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal"
                        data-target="#ingreso">
                        <i class="ti-plus btn-icon-prepend"></i> Crear ingreso
                    </button>
                 {{--    @endcan --}}
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabla_ingresos" class="table dt-responsive table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de creación</th>
                                    <th>Creador</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ingresos as $ingreso) 
                                <tr>
                                    <td>{{ $ingreso->id}}</td>
                                    <td>{{ $ingreso->created_at->locale('es')->isoFormat('dddd D \d\e MMMM')}}
                                        {{ $ingreso->created_at->locale('es')->isoFormat('Y H:m')}} 
                                    </td>
                                    <td>{{ $ingreso->name}} </td>
                                    <td>
                                        {{-- @can('minutas.mostar.edit') --}}
                                            <a href=" {{ url('ingresos/'.$ingreso->id.'/guias')}}" class="btn btn-outline-primary btn-sm">Ver guias</a>
                                       {{--  @endcan --}}
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

<!-- modal para agregar nueva minuta -->
<div class="modal fade" id="ingreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Esta seguro de crear un nuevo ingreso?</p>
        </div>
        <div class="modal-footer"> 
            <form action="{{ url('/ingresos') }}" class="forms-sample" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                </div>
                <button type="submit" class="btn btn-primary me-2"><i class="mdi mdi-plus"></i> Crear ingreso</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- Final modal para agregar nueva minuta -->
@endsection

@section('js')
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
$(function() {
    $('#tabla_ingresos').DataTable({
        "order": [
            [0, "desc"]
        ],
        "pageLength": 50,
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
</script>
@endsection
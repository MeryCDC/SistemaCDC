@extends('layouts.master')
@section('content')
<div class="content">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            @if(Session::has('editEntrada'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Cambios guardados correctamente!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif


            <h4 class="card-title">Editar: {{ $ingreso->id }} </h4>
            {{-- <p class="card-description">
            </p> --}}
            <form action="{{ url('/entradas/'.$ingreso->id)}}" class="needs-validation" id="formGuias" method="POST" novalidate>
                @csrf
                {{ method_field('PATCH') }}
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tracking/Perteneciente</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="tgp" id="tgp" value="{{ $ingreso->tgp }}" autofocus>
                    <input type="hidden" name="id" id="id" value="{{ $ingreso->id }}">
                    <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Peso *</label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="peso" id="peso" class="form-control" value="{{ $ingreso->peso }}" required/>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alto *</label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="alto" id="alto" class="form-control" value="{{ $ingreso->alto }}" required/>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Largo *</label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="largo" id="largo" class="form-control" value="{{ $ingreso->largo }}" required/>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Ancho *</label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="ancho" id="ancho" class="form-control" value="{{ $ingreso->ancho }}" required/>
                </div>
              </div>
             
              <button type="submit" class="btn btn-primary me-2">Guardar cambios</button>
              <button class="btn btn-danger" id="btnClose">Cerrar</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
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

$(document).ready(function () {
    $('#btnClose').click(function () {
        window.opener.location.reload(true);
        window.close();
    });
});

function refreshAndClose() {
    window.opener.location.reload(true);
    window.close();
};

</script>
@endsection
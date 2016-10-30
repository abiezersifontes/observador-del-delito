@extends('layout.menu')
@section('sidebar')
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Suceso</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id">
          <label for="titulo">Titulo</label>
          <input type="text" class="form-control" id="titulo" name="titulo">

          <label for="delito">Delito</label>
          <input type="text" class="form-control" id="delito" name="delito">

          <label for="link">Link</label>
          <input type="text" class="form-control" id="link" name="link">

          <label for="descripcion">Descripcion</label>
          <textarea name="name" class="form-control" id="descripcion" rows="8" cols="40"></textarea>

          <label for="periodico">Periodico</label>
          <input type="text" class="form-control" id="periodico" name="periodico">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="actualizar" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div id="menssage-update" class=" alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong>Datos Actualizados</strong>
  </div>

  <div id="menssage-delete" class=" alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong>Datos Eliminados</strong>
  </div>


  <div class="container">
    <div class="row">
      <form >
        <input type="hidden" id="token" value="{!! csrf_token() !!}"/>
      </form>

      <div id="datos" class="col-lg-12 col-md-12 ">


      </div>
      </br></br>
    </div>
  </div>


@endsection
@section('scripts')
  {!!Html::script('js/script.js')!!}
@endsection

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
          <select class="form-control" name="delito" id="delito">
            <option value="Asesinato">Asesinato</option>
            <option value="Robo">Robo</option>
            <option value="Extorsion">Extorsion</option>
            <option value="Violacion">Violacion</option>
            <option value="Trafico_de_drogas">Trafico de drogas</option>
            <option value="Indefinido">Indefinido</option>
            <option value="No_delito">No delito</option>
          </select>

          <label for="fecha"></label>
          <input type="date" class="form-control" id="fecha" name="fecha">
          
          <label for="link">Link</label>
          <input type="text" class="form-control" id="link" name="link">

          <label for="descripcion">Descripcion</label>
          <textarea name="name" class="form-control" id="descripcion" rows="8" cols="40"></textarea>

          <label for="periodico">Periodico</label>
          <input type="text" class="form-control" id="periodico" name="periodico">

          <label for="estado">Estado</label>
          <select name="estado" class="form-control" id="estado">
            <option value="Bolivar">Bolívar</option>
            <option value="Otros">Otros</option>
            <option value="Desconocido">Desconocido</option>
          </select>

          <label for="municipio">Municipio</label>
          <select name="municipio" class="form-control" id="municipio">
            <option value="Heres">Heres</option>
            <option value="Otros">Otros</option>
            <option value="Desconocido">Desconocido</option>
          </select>

          <label for="parroquia">Parroquia</label>
          <select name="parroquia" class="form-control" id="parroquia">
            <option value="Agua_salada">Agua Salada</option>
            <option value="Catedral">Catedral</option>
            <option value="Jose_antonio_paez">Jose Antonio Paez</option>
            <option value="La_sabanita">La Sabanita</option>
            <option value="Marhuanta">Marhuanta</option>
            <option value="Orinoco">Orinoco</option>
            <option value="Panana">Panapana</option>
            <option value="Zea">Zea</option>
            <option value="Otros">Otros</option>
            <option value="Desconocido">Desconocido</option>
          </select>


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

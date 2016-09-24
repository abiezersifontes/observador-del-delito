
<table class="table hover table-bordered">
  <thead>
    <th>Titulo</th>
    <th>Delito</th>
    <th>Link</th>
    <th>Descripcion</th>
    <th>Periodico</th>
    <th>Acciones</th>
  </thead>
  @foreach($articulos as $articulo)
    <tbody>
    <td>{{$articulo->titulo}}</td>
    <td>{{$articulo->delito}}</td>
    <td>{{$articulo->link}}</td>
    <td>{{$articulo->descripcion}}</td>
    <td>{{$articulo->periodico}}</td>
    <td>
      <button type="button" OnClick="Eliminar(this);" value="{{$articulo->id}}" class="btn btn-danger" name="button">Eliminar</button>
      <button type="button" class="btn btn-warning" OnClick="Mostrar(this);" value="{{$articulo->id}}" name="button" data-toggle="modal" data-target="#myModal">Modificar</button>
    </td>
  </tbody>
</table>
@endforeach
{!! $articulos->render() !!}

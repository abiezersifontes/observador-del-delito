@extends('layout.menu')
@section('sidebar')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 ">
        </br></br>

          {!! Form::model($articulo,['route' => ['articulo.update',$articulo->id], 'method' => 'PUT'])!!}
            <div class="form-group">
              {!!Form::label('titulo', 'Titulo')!!}
              {!!Form::text('titulo',$articulo->titulo,['class' => 'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('delito', 'Delito')!!}
              {!!Form::text('delito',$articulo->delito,['class' => 'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('link', 'Link')!!}
              {!!Form::text('link',$articulo->link,['class' => 'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('descripcion', 'Descripcion')!!}
              {!!Form::textarea('descripcion',$articulo->descripcion,['class' => 'form-control'])!!}
            </div>
            <div class="form-group">
              {!!Form::label('periodico', 'Periodico')!!}
              {!!Form::text('periodico',$articulo->periodico,['class' => 'form-control'])!!}
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
          {!! Form::close() !!}
        </br></br>
      </div>
    </div>
  </div>
@endsection

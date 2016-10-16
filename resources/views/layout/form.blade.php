<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
      {!!Form::model($user, ['route' => ['usuario.update', $user -> id], 'method' => 'PUT'])!!}
				@include('usuario.forms.usr')
				{!!Form::submit('Editar', ['class'=>'btn btn-primary'])!!}
				{!!link_to('/usuario', $title='Ver Usuarios', $attributes = ['class' => 'btn btn-default'], $secure = null)!!}
			{!!Form::close()!!}
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

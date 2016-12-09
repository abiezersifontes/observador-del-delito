$(document).ready(function(){
  Carga(1);
});

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var route = "listarticulos";
    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $('#datos').html(data);
        }
    });
});

function Mostrar(btn){

  route = 'articulo/'+btn.value+'/edit';

  $.get(route,function(art){
    $('#id').attr("value",art.id);
    $('#titulo').val(art.titulo);
    $('#link').val(art.link);
    $('#descripcion').val(art.descripcion);
    $('#periodico').val(art.periodico);
    $('#fecha').val(art.fecha);
    var delito = $('#delito').val(art.delito);
    var estado = $('#estado').val(art.estado);
    var municipio = $('#municipio').val(art.municipio);
    var parroquia = $('#parroquia').val(art.parroquia);

    for(var e = 1; e < 7; e++){
      var del = $('#delito > option:nth-child('+i+')').val();
      if(del == delito){
        del.attr('selected','selected');
      }
    }
    for(var i = 1; i < 3; i++) {
      var est = $('#estado > option:nth-child('+i+')').val();
      // var esta = est.val();
      if( est == estado){
        est.attr('selected','selected');

      }
    }
    for(var i = 1; i < 3; i++) {
      var est = $('#estado > option:nth-child('+i+')').val();
      // var esta = est.val();
      if( est == estado){
        est.attr('selected','selected');

      }
    }
    for(var o = 1; o < 3; o++) {
      var mun = $('#municipio > option:nth-child('+o+')').val();
      if( mun == municipio){
        est.attr('selected','selected');
      }
    }

    for(var u = 1; u < 10; u++) {
      var mun = $('#parroquia > option:nth-child('+u+')').val();
      if( mun == municipio){
        est.attr('selected','selected');
      }
    }


  });

}


function Carga(pagina){
	var tablaDatos = $("#datos");
	var route = "listarticulos";

	$("#datos").empty();
  var page = pagina;
  var route = "listarticulos";
  token = $('#token').val();
  $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      data: {page: page},
      type: 'GET',
      dataType: 'json',
      success: function(data){
          $('#datos').html(data);
      }
  });
}

function Eliminar(btn){
  route = "articulo/"+btn.value;
  token = $('#token').val();

  $.ajax({
    url: route,
    headers:{'X-CSRF-TOKEN': token},
    type: 'DELETE',
    dataType:'json',
    success:function(){
      Carga(1);
			$("#menssage-delete").fadeIn();
      $("#menssage-delete").fadeOut("slow");
    },
    error:function(xhr, ajaxOptions, thrownError){
      console.log(xhr.status);
    }
  });
}

$("#actualizar").click(function(){
  id = $('#id').val();
  titulo = $('#titulo').val();
  delito = $('#delito').val();
  link = $('#link').val();
  descripcion = $('#descripcion').val();
  periodico = $('#periodico').val();
  estado = $('#estado').val();
  municipio = $('#municipio').val();
  parroquia = $('#parroquia').val();
	var route = "articulo/"+id;
	var token = $('#token').val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data: {id:id,titulo:titulo,delito:delito,link:link,descripcion:descripcion,periodico:periodico,estado:estado,municipio:municipio,parroquia:parroquia},
		success: function(json){
      pagina = $('.active').val();
      Carga(pagina);
			$("#myModal").modal('toggle');
			$("#menssage-update").fadeIn();
      $("#menssage-update").fadeOut("slow");

		},
    error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
          }
	});
});

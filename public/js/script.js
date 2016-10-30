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
    $('#delito').val(art.delito);
    $('#link').val(art.link);
    $('#descripcion').val(art.descripcion);
    $('#periodico').val(art.periodico);
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
      //$("#menssage-delete").fadeOut("slow");
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
	var route = "articulo/"+id;
	var token = $('#token').val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data: {id:id,titulo:titulo,delito:delito,link:link,descripcion:descripcion,periodico:periodico},
		success: function(json){
      pagina = $('.active').val();
      alert(pagina);
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

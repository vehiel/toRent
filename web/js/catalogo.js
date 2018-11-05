function agregarCarrito(){
  // alert("click");
  // return;
  ncl = parseInt($('#inputUsuario').val());
  if(isNaN(ncl)){
    $.growl.error({ message: 'Error al buscar usuario en sesión'});
    return;
  }
  chr = parseInt($('#inputHerramienta').val());
  if(isNaN(chr)){
    $.growl.error({ message: 'Error al con el id de la herramienta'});
    return;
  }
  can = parseInt($('#inputCantidadModal').val());
  if(isNaN(can)){
    $.growl.error({ message: 'La cantida debe ser un numero entero'});
    return;
  }
  // $.growl.notice({ message: 'ok'});
  // return;

  $.ajax({
    'url':'?r=tr12detalq/agregar-articulo-catalogo',
    'method': 'post',
    'dataType':'json',
    'data':{'ncl_06in':ncl,'chr_10in':chr,'can_12in':can},
    success: function(data){
      if(data.ok){
        $.growl.notice({ message: data.msj});
        $('#moreInfo').modal('hide');
        return;
      }else{
        $.growl.error({ message: data.msj});
        return;
      }
    },
    error: function(){
      $.growl.error({ message:'<span class="glyphicon glyphicon-bullhorn"></span> <strong> Error interno!</strong>'+
      'Por favor contactenos y comente lo sucedido' });
      return;
    }
  });
}

$(function(){/*equivale a document.ready*/
	// alert("ready x2");
});
$('.btnMas').on('click', function(){
//   alert("click ");
// return;
id = $(this).attr('id');
$('#moreInfo').find('#content').load($(this).attr('value'), function(){
  $('#inputHerramienta').val(id);
});

// $('#ima_10vc').fileinput({
//         showUpload: false,
//         dropZoneEnabled: false,
//         maxFileCount: 10,
//         mainClass: "input-group-lg"
//     });
});

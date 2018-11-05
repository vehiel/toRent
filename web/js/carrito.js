/*redirecciona a la ruta de actualizar articulo desde el cliente*/
function actulizarCantidadArticulo(idOrden){
  href = $('#actualizarArticuloUrl').val();
  cantidad = parseInt($('#cantidadArticulo').val());
  if (isNaN(cantidad)) {
    return;
  }else if(cantidad <= 0){
    return;
  }
  $(location).attr('href',href+'&can='+cantidad+'&idOrden='+idOrden);
}
/*cuando se hace click en un btn update del GridView muestra el modal update cantidad y agrega la cantidad actual*/
$('.btnUpdateArticulo').on('click', function(event){
  event.preventDefault();
  /*la cantida esta el el mismo btn de actualizar*/
  cantidad = $(this).attr('value');
  /*se usa la url que tiene el btn que produjo el evento*/
  href = $(this).attr('href');
  /*se muestra el modal y se ingresa la cantidad actual de articulos en el input*/
  $('#modalUpdateArticulo').modal('show').find('#cantidadArticulo').val(cantidad);
  /*ademas se pone la url escondida en el modal*/
  $('#modalUpdateArticulo').find('#actualizarArticuloUrl').val(href);
});

$(function(){ /* doc ready*/
  // $.growl.notice({ message: '<span class="glyphicon glyphicon-ok-sign"></span> <strong>Carrito Actualizado'});
});

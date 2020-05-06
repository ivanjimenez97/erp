$(document).ready(function(){
 /*Este fragmento de codigo fue hecho para eliminar todos los productos
 de la cotización que esta en proceso de creación.*/

/*En esta linea de codigo se le indica a las siguientes clases
y id's que haran uso del plugin inputmask para que de el formato de 
moneda a esos inputs.*/

$(".totallist, .listprice, .preciou, .precioapagar, #subtotal, #iva, #total").inputmask("currency",{alias: "currency",removeMaskOnSubmit: true });
  $("#cleanCart").on("click", function(){
    
    var lista = $(this).data("id-producto");
    if (idproducto != '') 
    {
      $.ajax({
        url: "/cotizaciones/cleanCart",
        method:"GET",
        data:{idproducto : idproducto},
        success:function(data)
        {

          //$('#countCart').html(data);
        }
      })
    }
  });
//Esta funcion es para calcular el subtotal, iva y total.
function operacionescot(){
    subtotal= 0.00;
    iva = 0.00;
    totalpre= 0.00;


    $(".precioapagar").each(function(){
      precio = $(this).inputmask('unmaskedvalue');
      subtotal += parseFloat(precio);
      console.log(subtotal);
      iva = (subtotal * .16);
      console.log(iva);
      totalpre = subtotal + iva;
      console.log(totalpre);
      var signo = "$";

      $('#subtotal').val(subtotal.toFixed(2));
      $('#iva').val(iva.toFixed(2));
      $('#total').val(totalpre.toFixed(2));
      //$("#subtotal, #iva, #total").inputmask({alias: "currency"});
      
    });  
}
 /*Este fragmento de codigo fue hecho para hacer las operaciones
 de los precios, cantidades, precios a pagar, subtotales, iva y total
 en alguna cotizacion ya sea para una cotizacion en curso o una a
 editar.*/

 //aqui se manda a llamar a la funcion antes mencionada para que
 //calcule el subtotal, iva y total, antes de interactuar con la tabla
  operacionescot();
  $(".preciou, .quantity").on("keyup", function(){
    var producto_id = $(this).data('producto-id');

    var preciou = parseFloat($('#preciou-'+producto_id).inputmask('unmaskedvalue'));
    var quantity =  parseFloat($('#quantity-'+producto_id).inputmask('unmaskedvalue'));
    var signo = "$";
    var total = preciou * quantity;
    //var totaldollar = signo + total.toFixed(2);
    //$('#preciou-'+producto_id).inputmask({alias: "currency"});
    
    $('#precioapagar-'+producto_id).val(total.toFixed(2));

    /*Se manda a llamar a la funcion para que haga las operaciones
    de los resultados al momento de interactuar con las precios y
    cantidades.*/
    operacionescot();

  });
  
  /*Este fragmento de codigo fue hecho para borrar un producto 
  de la cotizacion que esta en proceso.*/
  $(".productselected").on("click", function(){
    
    var productselected = $(this).data("id-producto");
    console.log(productselected);
    $(".deleteProduct").on("click", function(){
    
      $.ajax({
        url: "/cotizaciones/deleteAProductFromCart",
        method:"GET",
        data:{idproducto:productselected},
        success:function(data)
        {
          //$('#countCart').html(data);
          console.log(productselected);
          
        }
      });
    });
  });


/*Este fragmento de codigo fue hecho para borrar un producto 
  de la cotizacion que esta siendo editada.*/
  $(".deleteItemQuote").on("click", function(){
    
    var itemq_id = $(this).data("id-itemquote");
    console.log(itemq_id);
    $(".confirmDeleteProduct").on("click", function(){
    
      $.ajax({
        url: "/cotizaciones/deleteAProductFromCartSaved",
        method:"POST",
        data:{itemq_id:itemq_id},
        success:function(data)
        {
          //$('#countCart').html(data);
          console.log(itemq_id);
          
        }
      });
    });
  });

    /*Este fragmento de código es para que al momento de seleccionar
un cliente, muestre los datos de este en los demas inputs*/
  load_data($('#client').val());

  function load_data(client)
  {
    $.ajax({
    url:"/cotizaciones/getClientId",
    method:"POST",
    data:{client:client},
    success: function(data)
    {
      $('#result').html(data);
       
    }
    });
  }  
  $('#client').on('change', function(){
    var client = $('#client').val();
    console.log(client);
    if(client != '')
    {
      load_data(client);
    }
    else
    {
      load_data();
    }
  });
    
  $('#client').on('change', function(){
    var client = $('#client').val();
    if(client != '')
    {
      $.ajax({
        url:"/cotizaciones/areaCliente",
        method:"POST",
        data:{client:client},
        success: function(data)
        {

          $('#area_cliente').html(data);
          $('#notice').html(data);
        }
      });
    }
  });

    $('#client').on('change', function(){
    var client = $('#client').val();
    if(client != '')
    {
      $.ajax({
        url:"/cotizaciones/clientquotenotice",
        method:"POST",
        data:{client:client},
        success: function(data)
        {
          $('#notice').html(data);
        }
      });
    }
  });
});
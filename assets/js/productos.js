$(document).ready(function(){
	$('#term').on('change', function(){
    var term = $('#term').val();
    if(term != '')
    {
      $.ajax({
        url:"/productos/terms",
        method:"POST",
        data:{term:term},
        success: function(data)
        {
          $('#subterm').html(data);
        }
      })
    }
  });

/*Este fragmento de codigo sirve para agregar productos
a la cotización*/
  $(".addToCart").on("click", function(){
    
    var idproducto = $(this).data("id-producto");
    if (idproducto != '') 
    {
      $.ajax({
        url: "/cotizaciones/addToCart",
        method:"GET",
        data:{idproducto:idproducto},
        success:function(data)
        {
          $('#countCart').html(data);
        }
      })
    }
  });
  
});
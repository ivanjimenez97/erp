
$(document).ready(function(){
        

        /*$('#estado_id').change(function(){

            var estado_id = $('#estado_id').val();
            
            $.post('/ajax/municipios/getMunicipios', {
                estado_id : estado_id
            }, function(data){
               $('#municipio_id').html(data);
            });

        });*/

    $('#estado').on('change', function(){
    var estado = $('#estado').val();
    if(estado != '')
    {
      $.ajax({
        url:"/clientes/municipios",
        method:"POST",
        data:{estado:estado},
        success: function(data)
        {
          $('#municipio').html(data);
        }
      })
    }
  });

$('select').select2();

});


   
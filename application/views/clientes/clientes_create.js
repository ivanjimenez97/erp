    $(function() {
        $('#estado_id').change(function(){

            var estado_id = $('#estado_id').val();
            
            $.post(base_url+'ajax/municipios/getMunicipios', {
                estado_id : estado_id
            }, function(data){
               $('#municipio_id').html(data);
            });

        });
    });


   
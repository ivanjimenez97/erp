function mostrarInput()
{
  elemento = document.getElementById("parent");
  check = document.getElementById("show_options");

  if (check.checked) {
    elemento.style.display='block';
  }
  else {
    elemento.style.display='none';
  }
}

//opcion 1
jQuery(document).ready(function(){
	$('#tid').on('change', function(){
    var tid = $('#tid').val();
    if(tid != '')
    {
      $.ajax({
        url:"/taxonomyterms/terms",
        method:"POST",
        data:{tid:tid},
        success: function(data)
        {
          $('#parent').html(data);
        }
      })
    }
  });
});

//opcion 2

/*$(document).ready(function(){
	$('#tid').on('change', function(){
		var tid = $(this).val();
		$.ajax({
			url:"<?=//base_url(); ?>application/controllers/taxonomyterms/get_all_taxtermbyparent",
			type: "POST",
			data:{'tid' : tid},
			dataType: 'json',
			success: function(data){
				alert('Ok');
			},
			error: function() {
				alert('Error occur..!!');
			}
		});
	});
});*/

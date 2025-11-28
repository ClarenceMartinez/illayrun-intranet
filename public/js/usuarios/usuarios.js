jQuery(document).on('click', '.btn-save-modal',function(e)
{
  	e.preventDefault();
  	var _this = $(this);
  	var data  = $("#"+_this.attr('data-form')).serialize(); 


	// var data   = $("#frm_usuarios").serialize();
	    // data = {"nombres": "Lucias", "apellidos": "mendez", "clave": "12321", "tipousuario_id": "2", "email": "lucia.chavez@hotmail.com", "email_verified_at": "2022-11-09 12:23:04", "estado": "1", "created_at": "2022-11-09 12:23:04", "updated_at": "2022-11-09 12:23:04","deleted_at":"2022-11-09 12:23:04"};
	    $.ajax({
	            url:ruta_usuarios_api+"usuarios/store",
	            data:data,
	            method:"POST",
	            dataType:'json',
	              success:function(response)
	              {
				  }
				})



})

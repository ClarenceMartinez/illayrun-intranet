(function ($) {
    'use strict';



    $(function () {
        // validate the comment form when it is submitted
        $("#registrarEncomienda").click(function () {
            $("#form_nueva_encomienda").validate({
                errorPlacement: function (label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
                highlight: function (element, errorClass) {
                    $(element).parent().addClass('has-danger')
                    $(element).addClass('form-control-danger')
                }
            });
            $.toast({
                heading: 'Success',
                text: 'El Registro de la encomienda fué Exitóso.',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            });
            // $.ajax({
            //     url: "",
            //     type: "post",
            //     dataType: "json",
            //     data: {},
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     // beforeSend: function() {
            //     //   $('.msg').html("<img src='img/ajax-loader.gif' />");
            //     // },
            // }).done(function (res) {
            //     $.toast({
            //         heading: 'Success',
            //         text: 'El Registro de la encomienda fué Exitóso.',
            //         showHideTransition: 'slide',
            //         icon: 'success',
            //         loaderBg: '#f96868',
            //         position: 'top-right'
            //     });
            //     // if(res.a == "1"){

            //     //   // Mostramos el mensaje 'Tu Mensaje ha sido enviado Correctamente !'
            //     //   $(".msg").html(res.b);
            //     //   $("#formulario_contacto").trigger("reset");

            //     // }  else {
            //     //   $(".msg").html(res.b);
            //     // }

            // }).fail(function (res) {
            //     $.toast({
            //         heading: 'Danger',
            //         text: 'Oops!, ha ocurrido un error al procesar el registro.',
            //         showHideTransition: 'slide',
            //         icon: 'error',
            //         loaderBg: '#f2a654',
            //         position: 'top-right'
            //     });
            // });




            // alerta de exito


            //

        });

        $("#aggItemEncomienda").click(function () {
            console.log('probando el click');
            $(".tableEncomienda tbody").append('<tr><td class="pt-1 pb-1"><input type="text" class="form-control form-control-sm" name="cantidad[]" ></td><td class="pt-1 pb-1"><input type="text" class="form-control form-control-sm" name="descripcion[]" ></td> <td class="pt-1 pb-1"><input type="text" class="form-control form-control-sm" name="peso[]" ></td> <td class="pt-1 pb-1"><input type="text" class="form-control form-control-sm" name="total[]"  readonly></td><td class="pt-1 pb-1"><button type="button" id="deleteItemEncomienda" class="btn btn-link text-danger"><i class="ti-trash"></i></button></td></tr>');

        });

        $('.tableEncomienda tbody').on('click', '#deleteItemEncomienda', function () {
            $(this).parents('tr').eq(0).remove();
        });

    });
})(jQuery);

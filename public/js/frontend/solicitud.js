var buttonpressed;
var clicando = false;

function button_enviar(form) {
    if (!clicando){
        swal.fire({
            title: 'Desea guardar los cambios?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.value) {
                clicando= true;
                $("#myform").submit();
            }
        });
    }else{

    }
}

$('#myform').on('submit', function(e) {
    var el = $('#myform'); e.preventDefault();
    var str_errors;
    $.ajax({
        type:           "POST",
        url:            el.attr('action'),
        data:           new FormData(this),
        processData:    false,
        contentType:    false,
        success:        function(data) {
            console.log(data);
            Swal.fire(
                'Guardado!',
                'El registro ha sido guardado.',
                'success'
            ).then(function() {
                clicando= false;
                if(data.route_redirect!=""){ window.location = data.route_redirect; }
            });
        },
        error: function(json)
        {
            clicando= false;
            let jsonString = data.responseJSON;
            let str_errors = "";
            if (data.status === 422) {
                str_errors = 'Faltan campos requeridos (*) y/o hay campos llenados incorrectamente.';
            }
            if (data.status === 409) {
                str_errors = jsonString.msg;
            }

            Swal.fire(
                '<b>Advertencia!</b>. Los datos no han sido guardados.',
                str_errors,
                'error'
            );
        }
    });
});

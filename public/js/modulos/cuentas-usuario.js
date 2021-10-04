var buttonpressed;
var clicando = false;
var dt_defaultt;

function button_submit(form) {
    if (!clicando){
        swal.fire({
            title: 'Desea guardar los cambios?',
            /*text: "No podrá revertir!",*/
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.value) {
                clicando= true;
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: 'json', // changing data type to json
                    success: function (data) { // here I'm adding data as a parameter which stores the response
                        console.log(data); // instead of alert I'm changing this to console.log which logs all the response in console.
                        Swal.fire(
                            'Guardado!',
                            'El registro ha sido guardado.',
                            'success'
                        ).then(function() {
                            clicando= false;
                            if(data.route_redirect!=""){ window.location = data.route_redirect; }
                        });

                    },
                    error: function (data) {
                        clicando= false;
                        let jsonString = data.responseJSON;
                        if (data.status === 422) {
                            messages_validation(null, false);
                            str_errors = 'Faltan campos requeridos (*) y/o hay campos llenados incorrectamente.'
                            messages_validation(jsonString.errors, true);
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
            }
        });
    }else{

    }
    /*data:           new FormData(this),
    processData:    false,
    contentType:    false,*/

}

function button_eliminar(id) {
    let url_eliminar= project_name + "/cuentas-usuario/"+id;
    let form= $('#frmdestroy');
    form.attr('action', url_eliminar);
    let texto= "";
    swal.fire({
        title: 'Desea  &nbsp;<span class="badge badge-danger">eliminar</span>'+ '&nbsp; a este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json', // changing data type to json
                success: function (data) { // here I'm adding data as a parameter which stores the response
                    //console.log(data); // instead of alert I'm changing this to console.log which logs all the response in console.
                    Swal.fire(
                        'Exito!',
                        'El registro ha sido eliminado.',
                        'success'
                    );
                    clean_table();
                    fill_table({});
                },
                error: function (data) {
                    let jsonString = data.responseJSON;
                    str_errors = jsonString.msg;
                    if (data.status === 409) {
                        str_errors = jsonString.msg;
                    }
                    Swal.fire(
                        '<b>Advertencia!</b>. El cliente no ha sido eliminado.',
                        str_errors,
                        'error'
                    );
                }
            });
        }
    });
}

function messages_validation(fields, show){
    if(show==true){
        //alert(2);
        $.each(fields, function(key, value) {
            $('#el-'+key).html(value);
            $('#'+key).addClass('is-invalid');
        });
    }else{
        $('.lbl-error').html("");
        $('.lbl-error').removeClass('is-invalid');
        $('.form-control').removeClass('is-invalid');

    }

}

function fill_table(data_search) {
    let url = project_name + "/cuentas-usuario/get-all";

    dt_defaultt = $('#dt_default').DataTable({
        responsive: true,
        "processing": true,
        "searching": true,
        "responsive": true,
        "language": {
            "url": project_name + "/js/spanish.json"
        },
        "ajax": {
            "dataType": 'json',
            "contentType": "application/json; charset=utf-8",
            "type": "GET",
            "url": url,
            "data": data_search,
            "dataSrc": function (jsonData) {
                return jsonData;
            }
        },
        "columns": [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center',
                "title": "#",
                "width": "10px"
            },
            { "data": "cliente", "title": "Cliente", "className": 'text-left' },
            { "data": "name", "title": "Nombre", "className": 'text-left' },
            { "data": "nickname", "title": "Nickname", "className": 'text-left', "width": "100px" },
            { "data": "rol", "title": "Rol", "className": 'text-left', "width": "100px" },
            { "data": "activo", "title": "Activo", "className": 'text-center', "width": "50px" },
            {
                "data": {"id":"id"},
                "render": function (data) {
                    let url_edit = project_name + "/cuentas-usuario/"+data.id+"/edit";
                    let cambiar_contraseña= project_name + "/cuentas-usuario/contrasenia/" + data.id;
                    let cadena= `
                                    <a href='`+cambiar_contraseña+`' class='btn btn-sm btn-info mr-2' title='Cambiar contraseña'><i class=\"fal fa-lock-alt\"></i></a>
                                    <a onclick='button_eliminar(`+data.id+`)' class='btn btn-sm btn-danger mr-2' title='Eliminar registro'><i class=\"fal fa-trash\"></i></a>
                                    <a href='`+url_edit+`' class='btn btn-sm btn-warning mr-2' title='Editar registro'><i class=\"fal fa-edit\"></i></a>
                                `;

                    return cadena;
                },
                "title": "Accion", "width": "140px", "className": 'text-center'
            }
        ]
    });
}

function clean_table() {
    dt_defaultt.clear();
    dt_defaultt.destroy();
    $('#dt_default').empty();
}

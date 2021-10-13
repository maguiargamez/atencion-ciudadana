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
    let url_eliminar= project_name + "/solicitudes/"+id;
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
                    fill_table({
                        'id_status' : 1
                    });
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
    let url = project_name + "/solicitudes/get-all";
    //alert(data_search.id_status);

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
            { "data": "folio", "title": "Folio", "className": 'text-left' , "width": "50px" },
            { "data": "tipo_servicio", "title": "Servicio", "className": 'text-left' , "width": "350px" },
            { "data": "descripcion_reporte", "title": "Reporte", "className": 'text-left' },
            {
                "data": {"id":"id"},
                "render": function (data) {
                    let url_edit = project_name + "/solicitudes/"+data.id;
                    let cadena= `
                                    <a onclick='button_eliminar(`+data.id+`)' class='btn btn-sm btn-danger mr-2' title='Eliminar registro'><i class=\"fal fa-trash\"></i></a>
                                    <a href='`+url_edit+`' class='btn btn-sm btn-info mr-2' title='Ver registro'><i class=\"fal fa-search\"></i></a>
                                `;

                    return cadena;
                },
                "title": "Accion", "width": "90px", "className": 'text-center'
            }
        ]
    });
}

function clean_table() {
    dt_defaultt.clear();
    dt_defaultt.destroy();
    $('#dt_default').empty();
}

function add_seguimiento(accion){

    let descripcion= "Descripción del seguimiento";
    let titulo= "Agregar segumiento";
    if(accion==3){
        descripcion="Motivo de cancelación";
        titulo="Cancelar";
    }
    if(accion==2){
        descripcion="Primer seguimiento:";
        titulo="Aceptar trámite";
    }
    if(accion==4){
        descripcion="Descripción de finalización:";
        titulo="Finalizar trámite";
    }



    $("#id_accion").val(accion);
    $("#txt-descripcion").text(descripcion);
    $("#txt-titulo").text(titulo);

    $("#modal-seguimiento").modal('show');
}

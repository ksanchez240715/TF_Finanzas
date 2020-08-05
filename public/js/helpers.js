/**
 * Created by Kevin-Sánchez on 03 Oct 2018.
 * ksanchez240715@gmail.com
 *
 */

function getDataTableConfiguration(configuration) {
    return {
        dom: '<"right"i>rt<"left"flp><"clear">',
        responsive: true,
        processing: false,
        serverSide: true,
        filter: false,
        // lengthChange: true,
        "bInfo" : false,
        "bLengthChange" : false,
        "pageLength": configuration.pagelength,
        ordering: true,
        orderMulti: false,
        pagingType: "full_numbers",
        columnDefs: [
            { "orderable": false, "targets": configuration.orderable }
        ],
        language: {
            "processing": "<div class='overlay custom-loader-background'><i class='fa fa-cog fa-spin custom-loader-color'></i></div>",
            // "processing": "CARGANDO...",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando la página _PAGE_ de _PAGES_ - Se encontraron _TOTAL_ registros",
            "infoFiltered": "_MAX_ / _TOTAL_",
            "paginate": {
                "next": "+",
                "previous": "-",
                "first": "Inicio",
                "last": "Fin"
            }
        },
        ajax: {
            url: parseURL()+(configuration.url),
            type: "GET",
            dataType: "JSON",
            data: configuration.data
        },
        columns: configuration.columns
    };
}

function createModal(result,modalHTML = "modal_form2",contentHTML = "modal-content2") {
    $("#"+contentHTML).html(result);
    $("#"+modalHTML).modal({
        show: true
    });
}

function editModal(result,modalHTML = "modal_form2",contentHTML = "modal-content2") {
    $("#"+contentHTML).html(result);
    $("#"+modalHTML).modal({
        show: true
    });
}

function hideModal(result,modalHTML = "modal_form2",contentHTML = "modal-content2") {
    $("#"+contentHTML).html(result);
    $("#"+modalHTML).modal({
        show: false
    });
}


function postCreateModel(tables,modalHTML = "modalget") {
    $("#"+modalHTML).on('submit','#add-form',function(e){
        e.stopImmediatePropagation();
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
            }).always(function (parameters) {
                $('#'+modalHTML).modal('hide');
                $.each(tables,function (i,item) {
                    item.draw();
                });
            }).done(function (parameters) {
                if(parameters == 200)
                    showSuccessSwalCreate();
                else{
                    showErrorSwal();
                }
            }).fail(function (parameters) {
                showErrorSwal();
            });
        }
    });
}

function postUpdateModel(tables,modalHTML = "modalget") {
    $("#"+modalHTML).on('submit','#edit-form',function(e){
        e.stopImmediatePropagation();
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
            }).always(function (parameters) {
                $('#'+modalHTML).modal('hide');
                $.each(tables,function (i,item) {
                    item.draw();
                });
            }).done(function (parameters) {
                if(parameters == 200)
                    showSuccessSwalEdit();
                else{
                    showErrorSwal();
                }
            }).fail(function (parameters) {
                showErrorSwal();
            });
        }
    });
}
function showConfirmSwalAJAXGET(configuration) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: configuration.text,
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !swal.isLoading(),
        preConfirm: configuration.promise
    });
}

function showDeleteSwal(configuration) {
    swal({
        type: "warning",
        title: "¿Está seguro?",
        text: "El registro será eliminado permanentemente",
        showCancelButton: true,
        confirmButtonText: "Sí, elmininar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !swal.isLoading(),
        preConfirm: configuration.promise
    });
}

function showSuccessSwalCreate(text = "Se registraron correctamente los datos") {
    swal({
        type: "success",
        title: "Creado",
        text: text,
        confirmButtonText: "Cerrar"
    });
}

function showSuccessSwalEdit(text = "Se actualizaron correctamente los datos") {
    swal({
        type: "success",
        title: "Editado",
        text: text,
        confirmButtonText: "Cerrar"
    });
}

function showSuccessSwalDelete(text = "Se elimino correctamente el registro") {
    swal({
        type: "success",
        title: "Eliminado",
        text: text,
        confirmButtonText: "Cerrar"
    });
}

function showSuccessAlertAdminDelete(text = "No puede eliminar el usuario con el que se encuentra conectado") {
    swal({
        type: "warning",
        title: "¡ Advertencia !",
        text: text,
        confirmButtonText: "Cerrar"
    });
}

function showErrorSwal(text = "Ocurrio un error en la solicitud, comuniquese con el administrador") {
    swal({
        type: "error",
        title: "Error",
        text: text,
        confirmButtonText: "Ok"
    });
}


Object.defineProperty(String.prototype, "proto", {
    value: function () {
        var self = this;
        var result = {
            decode: function () {
                var result = self;

                if (result) {
                    result = window.atob(result);
                    result = JSON.parse(result);
                }

                return result;
            },
            ellipsis: function (start, end) {
                var str = self;
                var ellipsis = "";

                if (start > 0) {
                    ellipsis = str.substring(start, str.length);
                    ellipsis = "..." + ellipsis;
                }

                if (end < str.length) {
                    ellipsis = str.substring(0, end);
                    ellipsis = ellipsis + "...";
                }

                return ellipsis;
            },
            format: function () {
                var str = self;

                for (argument in arguments) {
                    str = str.replace("{" + argument + "}", arguments[argument]);
                }

                return str;
            },
            hash: function () {
                var str = self;
                var hash = 0;

                for (var i = 0; i < str.length; ++i) {
                    hash = str.charCodeAt(i) + ((hash << 5) - hash);
                }

                return hash;
            },
            parseBaseURL: function (baseUrl) {
                var str = self;
                var url = window.location.protocol;
                url += "//";
                url += window.location.host;
                url += baseUrl;
                url += str;

                return url;
            },
            parseURL: function () {
                var str = self;
                var url = window.location.protocol;
                url += "//";
                url += window.location.host;
                url += "/";
                url += str;

                return url;
            },
            toRGB: function () {
                var str = self;
                var hash = str.proto().hash();
                var rgb = hash.proto().toRGB();

                return rgb;
            }
        };

        return result;
    },
    enumerable: false
});

$.fn.extend({
    donetyping: function (callback, timeout) {
        timeout = timeout || 1e3; // 1 second default timeout
        var timeoutReference,
            doneTyping = function (el) {
                if (!timeoutReference) return;
                timeoutReference = null;
                callback.call(el);
            };
        return this.each(function (i, el) {
            var $el = $(el);
            // Chrome Fix (Use keyup over keypress to detect backspace)
            // thank you @palerdot
            $el.is(':input') && $el.on('keyup keypress paste', function (e) {
                // This catches the backspace button in chrome, but also prevents
                // the event from triggering too preemptively. Without this line,
                // using tab/shift+tab will make the focused element fire the callback.
                if (e.type == 'keyup' && e.keyCode != 8) return;

                // Check if timeout has been set. If it has, "reset" the clock and
                // start over again.
                if (timeoutReference) clearTimeout(timeoutReference);
                timeoutReference = setTimeout(function () {
                    // if we made it here, our timeout has elapsed. Fire the
                    // callback
                    doneTyping(el);
                }, timeout);
            }).on('blur', function () {
                // If we can, fire the event since we're leaving the field
                doneTyping(el);
            });
        });
    }
});

function parseURL() {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
    return baseUrl;
}

function isTextKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 32 && (charCode < 65 || charCode > 90) && ( charCode < 97 || charCode > 122)  && ( charCode < 160 || charCode > 165) && charCode != 225 && charCode != 209 && charCode != 233 && charCode != 237 && charCode != 243 && charCode != 250 && charCode != 241)
        return false;
    return true;
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function validarEmail(valor) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
        return true;
    } else {
        return false;
    }
}


function showPageLoaderForLoading(targetClass = ".m-content") {
    mApp.block(targetClass, { type: "loader", message: "Cargando datos" });
}

function showPageLoaderForSaving(targetClass = ".m-content") {
    mApp.block(targetClass, { type: "loader", message: "Procesando los datos ingresados" });
}

function hidePageLoader(targetClass = ".m-content") {
    mApp.unblock(targetClass);
}

function showModalLoaderForLoading(targetClass = ".modal-content") {
    mApp.block(targetClass, { type: "loader", message: "Cargando datos" });
}

function showModalLoaderForSaving(targetClass = ".modal-content") {
    mApp.block(targetClass, { type: "loader", message: "Procesando datos" });
}

function hideModalLoader(targetClass = ".modal-content") {
    mApp.unblock(targetClass);
}

$(document).ready(function() {
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
        pattern: "Formato invalido"
    });
});

function matchStart(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }

    // Skip if there is no 'children' property
    if (typeof data.children === 'undefined') {
        return null;
    }

    // `data.children` contains the actual options that we are matching against
    var filteredChildren = [];
    $.each(data.children, function (idx, child) {
        if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
            filteredChildren.push(child);
        }
    });

    // If we matched any of the timezone group's children, then set the matched children on the group
    // and return the group object
    if (filteredChildren.length) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.children = filteredChildren;

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "Sábado"],
    daysShort: ["Dom", "Lun", "Mar", "Mir", "Jue", "Vie", "Sab"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Borrar",
    format: "yyyy-mm-dd",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};

function isTextKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 32 && (charCode < 65 || charCode > 90) && ( charCode < 97 || charCode > 122)  && ( charCode < 160 || charCode > 165) && charCode != 225 && charCode != 209 && charCode != 233 && charCode != 237 && charCode != 243 && charCode != 250 && charCode != 241)
        return false;
    return true;
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function validarEmail(valor) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
        return true;
    } else {
        return false;
    }
}



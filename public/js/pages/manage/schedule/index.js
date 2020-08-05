var baseUrl = "schedule";

function getDataTableSchedule(type) {
    var options = getDataTableConfiguration({
        url: `gestion/${baseUrl}/list`,
        data: function (data) {
            data.type = type;
        },
        pageLength:4,
        columns: [
            {
                data: "name",
                name: "name",
                title: "Titulo"
            },
            {
                data: "date_start",
                name: "date_start",
                title: "Fecha de Inicio"
            },
            {
                data: "date_end",
                name: "date_end",
                title: "Fecha de Cierre"
            },
            {
                data: null,
                title: "Opciones",
                render: function (row) {
                    return `<div class="table-options-section">
<!--                                <button data-id="${row.id}" class="btn btn-success btn-sm m-btn&#45;&#45;icon btn-detalle" title="Detalle"><i class="la la-eye"></i> Detalle</button>-->
                                <button data-id="${row.id}" class="btn btn-info btn-sm m-btn--icon btn-edit" title="Editar"><i class="la la-edit"></i> Editar</button>
                            </div>`;
                }

            }
        ]
    });
    return options;
}

var dtInscription =  $("#dt_inscription").DataTable(getDataTableSchedule(1));
var dtEvaluation =  $("#dt_evaluation").DataTable(getDataTableSchedule(2));
var dtLifting =  $("#dt_lifting").DataTable(getDataTableSchedule(3));
var dtObservation =  $("#dt_observation").DataTable(getDataTableSchedule(4));

$(".btn-division").on("click", function () {
    var button = $(this);
    button.attr('disabled',true);
        showConfirmSwalAJAXGET({
            text: "Se perderá el cronograma actual. ¿Desea continuar?",
            promise: () => {
                return new Promise((resolve) => {
                    $.ajax({
                        type: "GET",
                        url: `${baseUrl}/modal`
                    }).always(function (result) {
                        // dtAdministrative.draw();
                    }).done(function (result) {
                        swal.close()
                        createModal(result, 'modal_form1', 'modal-content');
                    }).fail(function (error) {
                        console.log(error);
                        showErrorSwal();
                    })
                })
            }
        });
    button.attr('disabled',false);
});

dtInscription.on("click",".btn-edit", function () {
    var button = $(this);
    getModalEditar(button);
});
dtEvaluation.on("click",".btn-edit", function () {
    var button = $(this);
    getModalEditar(button);
});
dtLifting.on("click",".btn-edit", function () {
    var button = $(this);
    getModalEditar(button);
});
dtObservation.on("click",".btn-edit", function () {
    var button = $(this);
    getModalEditar(button);
});

function getModalEditar(button) {
    button.attr('disabled',true);
    var data_id = button.data("id");
    console.log('Data - '+data_id);
    $.ajax({
        type: "GET",
        url: `${baseUrl}/edit/modal`,
        data: {
            invisible : data_id
        },
    }).always(function (result) {
        // dtAdministrative.draw();
    }).done(function (result) {
        swal.close()
        createModal(result);
    }).fail(function (error) {
        console.log(error);
        showErrorSwal();
    })
    button.attr('disabled',false);
}

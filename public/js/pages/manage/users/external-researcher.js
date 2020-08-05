var baseUrl = "gestion/usuario/personal";

var options = getDataTableConfiguration({
    url: `${baseUrl}/list`,
    data: function (data) {
        data.search = $("#search").val();
        data.type = $("#typeList").val();
    },
    pageLength:5,
    columns: [
        {
            data: "username",
            name: "username",
            title: "C&oacute;digo"
        },
        {
            data: "dni",
            name: "dni",
            title: "DNI"
        },
        {
            data: "name",
            name: "name",
            title: "Nombres"
        },
        {
            data: "fullName",
            name: "fullName",
            title: "Apellidos"
        },
        {
            data: "rol",
            name: "rol",
            title: "Rol"
        },
        {
            data: null,
            title: "Opciones",
            render: function (row) {
                return `<div class="table-options-section">
                                <button data-id="${row.id}" class="btn btn-info btn-sm m-btn--icon btn-detail" title="Detalle"><i class="la la-eye"></i> Detalle</button>
                                <a href="${parseURL()}${baseUrl}/update/${row.id}" class="btn btn-primary btn-sm m-btn--icon btn-edit" title="Editar"><i class="la la-edit"></i> Editar</a>
                                <button data-id="${row.id}" class="btn btn-danger btn-sm m-btn--icon btn-delete" title="Eliminar"><i class="la la-trash"></i> Eliminar</button>
                            </div>`;
            }

        }
    ]
});

var dtExternalResearcher =  $("#dt_external_researcher").DataTable(options);

$("#search").donetyping(function () {
    dtExternalResearcher.draw();
});

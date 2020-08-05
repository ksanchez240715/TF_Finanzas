

$("#select2TipoMoneda").select2({
    placeholder:"Tipo de Moneda",
    width: '100%',
    minimumResultsForSearch: -1
});

$("#select2FrecuenciaCupon").select2({
    placeholder:"Frecuencia Cupón",
    width: '100%',
    minimumResultsForSearch: -1
});

$("#select2DiasXAnio").select2({
    placeholder:"Días por Años",
    width: '100%',
    minimumResultsForSearch: -1
});


$("#select2TipoTasaInteres").select2({
    placeholder:"Tipo de tasa de interes",
    width: '100%',
    minimumResultsForSearch: -1
});

$("#select2TipoTasaInteres").on("change", function () {

    if(this.value === "N"){
        $("#idCapitalizacion").css("display","block");
    }
    else{
        $("#idCapitalizacion").css("display","none");
    }
});


$("#select2Capitalizacion").select2({
    placeholder:"Tipo de tasa de interes",
    width: '100%',
    minimumResultsForSearch: -1
});

$("#fechaEmisionBono").datepicker({
    format: 'dd/mm/yyyy',
    language: 'es',
    // startDate: '+1d',
    autoclose: true,
});


$("#add-form").validate();


$("#calcular").on("click",function () {
    let erros= 0;

    if($("#select2TipoMoneda").val() === "" ||
        $("#vNominal").val() === "" ||
        $("#vComercial").val() === "" ||
        $("#nAnios").val() === "" ||
        $("#select2FrecuenciaCupon").val() === "" ||
        $("#select2DiasXAnio").val() === "" ||
        $("#tasa_anual_descuento").val() === "" ||
        $("#impRenta").val() === "" ||
        $("#fechaEmisionBono").val() === "" ||
        $("#prima").val() === "" ||
        $("#select2Capitalizacion").val() === "" ||
        $("#estructuracion").val() === "" ||
        $("#colocacion").val() === "" ||
        $("#flotacion").val() === "" ||
        $("#cavali").val() === "" ||
        ($("#select2TipoTasaInteres").val() === "N" && $("#tasaInteres").val() === "")
    )
    {
        erros++;
    }

    if(erros > 0){
        swal("Advertencia", "Debe completar todos los campos", "warning");
        return false;
    }
    Results();
    dtFlujoPagos.draw();
});


var options = getDataTableConfiguration({
    // url: `${baseUrl}/list`,
    url: "list",
    data: function (data) {
        data.tipoMoneda = $("#select2TipoMoneda").val();
        data.vNominal = $("#vNominal").val();
        data.vComercial = $("#vComercial").val();
        data.nAnios = $("#nAnios").val();
        data.frecuenciaCupon = $("#select2FrecuenciaCupon").val();
        data.dias_x_anios = $("#select2DiasXAnio").val();
        data.tipo_tasa_interes = $("#select2TipoTasaInteres").val();
        data.capitalizacion = $("#select2Capitalizacion").val();
        data.tasaInteres = $("#tasaInteres").val();
        data.tasa_anual_descuento = $("#tasa_anual_descuento").val();
        data.impRenta = $("#impRenta").val();
        data.fechaEmisionBono = $("#fechaEmisionBono").val();
        data.prima = $("#prima").val();
        data.estructuracion = $("#estructuracion").val();
        data.colocacion = $("#colocacion").val();
        data.flotacion = $("#flotacion").val();
        data.cavali = $("#cavali").val();
    },
    pageLength:0,
    columns: [
        {
            data: "n",
            name: "n",
            title: "Nro"
        },
        {
            data: "fechaProgramada",
            name: "fechaProgramada",
            title: "Fecha Programada"
        },
        {
            data: "inflacionAnual",
            name: "inflacionAnual",
            title: "Inflaci&oacute;n Anual",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                return `<spam style="color: blue">${ (data*1).toFixed(2) } %</spam>`;
            }
        },
        {
            data: "inflacionDelPeriodo",
            name: "inflacionDelPeriodo",
            title: "Inflaci&oacute;n del Periodo",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                return `<spam style="color: blue">${ (data*1).toFixed(2) } %</spam>`;
            }
        },
        {
            data: "plazoDeGracia",
            name: "plazoDeGracia",
            title: "Plazo de Gracia",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                return data;
            }
        },
        {
            data: "bono",
            name: "bono",
            title: "Bono",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "bonoIndexado",
            name: "bonoIndexado",
            title: "Bono Indexado",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "cuponInteres",
            name: "cuponInteres",
            title: "Cupon (Interes)",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "cuota",
            name: "cuota",
            title: "Cuota",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "amortizacion",
            name: "amortizacion",
            title: "Amort.",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "prima",
            name: "prima",
            title: "Prima",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "escudo",
            name: "escudo",
            title: "Escudo",
            render: function (data,type,row,) {
                if(row.n === 0)
                    return "- - -";

                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "flujoEmisor",
            name: "flujoEmisor",
            title: "Flujo Emisor",
            render: function (data) {
                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "flujoEmisorConEscudo",
            name: "flujoEmisorConEscudo",
            title: "Flujo Emisor c/Escudo",
            render: function (data) {
                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        {
            data: "flujoBonista",
            name: "flujoBonista",
            title: "Flujo Bonista",
            render: function (data) {
                if(data < 0)
                    return `<spam style="color: red">${ (data*-1).toFixed(2) }</spam>`;
                else
                    return `<spam style="color: blue">${ (data*1).toFixed(2) }</spam>`;
            }
        },
        // {
        //     data: null,
        //     title: "Opciones",
        //     render: function (row) {
        //         return `<div class="table-options-section">
        //                         <button data-id="${row.id}" class="btn btn-info btn-sm m-btn--icon btn-detail" title="Detalle"><i class="la la-eye"></i> Detalle</button>
        //                         <a href="${parseURL()}${baseUrl}/actualizar/${row.id}/${$("#typeList").val()}" class="btn btn-primary btn-sm m-btn--icon btn-edit" title="Editar"><i class="la la-edit"></i> Editar</a>
        //                         <button data-id="${row.id}" class="btn btn-danger btn-sm m-btn--icon btn-delete" title="Eliminar"><i class="la la-trash"></i> Eliminar</button>
        //                     </div>`;
        //     }
        //
        // }
    ]
});

var dtFlujoPagos =  $("#dt_flujoPagos").DataTable(options);



const Results = () => {
    $.ajax({
        url: parseURL()+("datos_salida"),
        type: "GET",
        dataType: "JSON",
        data: {
            tipoMoneda : $("#select2TipoMoneda").val(),
            vNominal : $("#vNominal").val(),
            vComercial : $("#vComercial").val(),
            nAnios : $("#nAnios").val(),
            frecuenciaCupon : $("#select2FrecuenciaCupon").val(),
            dias_x_anios : $("#select2DiasXAnio").val(),
            tipo_tasa_interes : $("#select2TipoTasaInteres").val(),
            capitalizacion : $("#select2Capitalizacion").val(),
            tasaInteres : $("#tasaInteres").val(),
            tasa_anual_descuento : $("#tasa_anual_descuento").val(),
            impRenta : $("#impRenta").val(),
            fechaEmisionBono : $("#fechaEmisionBono").val(),
            prima : $("#prima").val(),
            estructuracion : $("#estructuracion").val(),
            colocacion : $("#colocacion").val(),
            flotacion : $("#flotacion").val(),
            cavali : $("#cavali").val()
        }
    }).done(function (result) {
        const { data } = result;
        $("#frecuenciaCupon").val(data.FrecuenciaCupon);
        $("#diasCapitalizacion").val(data.DiasCapitalizacion);
        $("#NroPeriodosXAnio").val(data.NPeriodosAnio);
        $("#nTotalPeriodos").val(data.NTotalPeriodos);
        $("#tea").val((data.TEA)+" %");
        $("#tep").val((data.TEP)+" %");
        $("#cokTep").val((data.COK)+" %");
        $("#costesInicialesEmisor").val(data.CostesInicialesEmisor);
        $("#costesInicialesBonista").val(data.CostesInicialesBonista);
        $("#precioActual").val(data.PrecioActual);
        $("#utilidadPerdida").val(data.UtilidadPerdida);
        $("#tceaEmisor").val((data.TCEAEmisor)+" %");
        $("#tceaEmisorEscudo").val((data.TCEAEmisorEscudo)+" %");
        $("#treaBonista").val((data.TREABonista)+" %");
    }).fail(function (error) {
        console.log("Ops!!!")
    })
};

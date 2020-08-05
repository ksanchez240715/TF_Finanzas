$("#select-roles").select2({
    placeholder:"Selecione los roles",
    width: '100%',
});
$("#select-group").select2({
    placeholder:"Selecione su grupo",
    width: '100%',
});

$("#select-level").select2({
    placeholder:"Selecione su nivel",
    width: '100%',
});

$("#select-condition").select2({
    placeholder:"Selecione su condición",
    width: '100%',
});

$("#dateBirthday").datepicker({
    autoclose: true,
    language: "es",
});


$("#add-form").validate({
    rules:{
        dni:{
            required: true,
            pattern: "[0-9]{8}"
        },
        name:{
            required: true
        },
        paternalLastName:{
            required: true
        },
        maternalLastName:{
            required: true
        },
        roles:{
            required: true
        },
        username:{
            required: true
        },
        password:{
            required: true
        },
        repassword:{
            required: true
        },
        address:{
            required: true
        },
        birthdate:{
            required: true
        },
        nationality:{
            required: true
        },
        email:{
            required: true,
            pattern: /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i
        },
        phoneNumber:{
            required: true,
            number: true
        },
        cellPhone:{
            required: true,
            number: true
        },
        group:{
            required: true
        },
        level:{
            required: true
        },
        condition:{
            required: true
        },
        sex:{
            required: true
        }
    },
    submitHandler: function (form) {
        form.submit();
        $("#add-form input").attr("disabled", true);
        $("#btnSave").attr("disabled", true);
        showPageLoaderForSaving();
    }
});

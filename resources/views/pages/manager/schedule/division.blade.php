<div class="modal-header">
    <h4 class="modal-title">Intervalo de tiempo</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

{{ Form::open(['route' => 'manage.schedule.save','class'=>'form-horizontal','id' => 'divider-form', 'method' => 'POST']) }}
    <div class="modal-body">
        <div class="alert alert-danger background-danger" style="display: none">
            <ul class="errors">
            </ul>
        </div>
        <div class="form-group row">
            <label class="col-sm-7 col-form-label">Intervalo de tiempo: </label>
            <div class="col-sm-4 col-sm-offset-2">
                {!! Form::text('divider', "", array('class' => 'form-control','id' => 'cantidad','min' => 1, 'max' => 12,'onkeypress' => 'return isNumberKey(event)','onpaste' => 'return false')) !!}
            </div>
        </div>
    </div>
    <div class="modal-footer button-demo" style="text-align: center;">
        <button type="submit" id="enviar" class="btn btn-primary btn-outline" data-style="zoom-out">Enviar</button>
    </div>
{!! Form::close() !!}

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $("#divider-form").validate({
        submitHandler: function (form) {
            if($("#cantidad").val() != '1' && $("#cantidad").val() != '2' && $("#cantidad").val() != '3' && $("#cantidad").val() != '4' && $("#cantidad").val() != '6' && $("#cantidad").val() != '12'){
                $('#enviar').prop('disabled', false);
                return false;
            }

            form.submit();
            $("#divider-form input").attr("disabled", true);
            $("#enviar").attr("disabled", true);
            showPageLoaderForSaving();
        }
    });

</script>

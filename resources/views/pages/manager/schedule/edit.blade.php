<div class="modal-header">
    <h4 class="modal-title">Fechas del Mes de {{ $objeto->name }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


{{ Form::open(['route' => 'manage.schedule.update','class'=>'form-horizontal','id' => 'form-validation-manager', 'method' => 'POST']) }}
{{ csrf_field() }}
{{ method_field('PUT') }}

<div class="modal-body">
    <div class="alert alert-danger background-danger" style="display: none">
        <ul class="errors">
        </ul>
    </div>
    {!! Form::hidden('ep',$objeto->id) !!}

    <div class="form-group row">
        <div class="col-lg-12">
            <h6 class="sub-title">Fecha de Inicio: </h6>
            @if(is_null($objeto->date_start))
                {!! Form::text('date_start',null, array('data-default-date' => '11-13-2016' ,'id' => 'dropper-default','class' => 'form-control calendar start','placeholder' => 'Seleccione la fecha','required'=>'true', 'readonly'=> 'readonly')) !!}
            @else
                {!! Form::text('date_start',date_format( new DateTime($objeto->date_start), 'd/m/Y' ), array('id' => 'dropper-default','data-default-date' => date_format( new DateTime($objeto->date_start), 'd/m/Y' ),'class' => 'form-control calendar start','placeholder' => 'Seleccione la fecha', 'readonly'=> 'readonly')) !!}
            @endif

        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-12">
            <h6 class="sub-title">Fecha de Fin: </h6>

            @if(is_null($objeto->date_end))
                {!! Form::text('date_end',null, array('data-default-date' => '11-13-2016','id' => 'dropper-default','class' => 'form-control calendar end','placeholder' => 'Seleccione la fecha','required'=>'true', 'readonly'=> 'readonly')) !!}
            @else
                {!! Form::text('date_end',date_format( new DateTime($objeto->date_end), 'd/m/Y' ), array('id' => 'dropper-default','data-default-date' => date_format( new DateTime($objeto->date_end), 'd/m/Y' ),'class' => 'form-control calendar end','placeholder' => 'Seleccione la fecha', 'readonly'=> 'readonly')) !!}
            @endif
        </div>
    </div>
</div>

<div class="modal-footer" >
    <div class="col-md-3" style="padding-right: 0">
        <button type="button" class="btn btn-primary btn-outline-primary btn-block" data-dismiss="modal">Cerrar</button>
    </div>
    <div class="col-md-3 button-demo" style="padding-left: 0">
        <button type="submit" id="enviar" class="btn btn-primary btn-block ladda-button" data-style="zoom-out">Guardar</button>
    </div>
</div>

{!! Form::close() !!}


{{--<script>--}}
{{--    Ladda.bind( '.button-demo button' );--}}

{{--    var name  = $('.toggle.active').data('black');--}}
{{--    var mes = '{{ $objeto->name }}';--}}

{{--    var Smonth = "{{ $objeto->month }}";--}}
{{--    var Tmonth = "{{ $objeto->name}}";--}}
{{--    $(".calendar.start").dateDropper({--}}
{{--        dropWidth: 200,--}}
{{--        format: "d/m/Y",--}}
{{--        dropPrimaryColor: "#70adc9",--}}
{{--        dropBorder: "1px solid #70adc9",--}}
{{--        minYear: "{{ date("Y") }}",--}}
{{--        animate: false,--}}
{{--        lang: "es",--}}
{{--        lock: false--}}
{{--    });--}}
{{--    $(".calendar.end").dateDropper({--}}
{{--        dropWidth: 200,--}}
{{--        format: "d/m/Y",--}}
{{--        dropPrimaryColor: "#70adc9",--}}
{{--        dropBorder: "1px solid #70adc9",--}}
{{--        minYear: "{{ date("Y") }}",--}}
{{--        animate: false,--}}
{{--        lang: "es",--}}
{{--        lock: false--}}
{{--    });--}}

{{--    $("#form-validation-manager").submit(function(event){--}}
{{--        event.stopImmediatePropagation();--}}
{{--        event.preventDefault();--}}
{{--        $('#enviar').attr('disabled',true);--}}
{{--        var dateArstart = $('.calendar.start').val();--}}
{{--        var dateArend = $('.calendar.end').val();--}}
{{--        var dateArstart = dateArstart.split('/');--}}
{{--        var dateArend = dateArend.split('/');--}}

{{--        if((dateArstart[1] != Smonth) || (dateArend[1] != Smonth)){--}}
{{--            $('#modal_schedule_times .modal-body .alert').css('display','block');--}}
{{--            $("#modal_schedule_times .modal-body .errors").empty();--}}
{{--            $('<li/>')--}}
{{--                .addClass('ui-menu-item')--}}
{{--                .attr('role', 'menuitem')--}}
{{--                .appendTo('#modal_schedule_times .modal-body .errors')--}}
{{--                .text('Debe ingresar una fecha del mes de '+Tmonth);--}}
{{--            $('#enviar').attr('disabled',false);--}}
{{--            Ladda.stopAll();--}}
{{--            return false;--}}
{{--        }--}}

{{--        $.ajax({--}}
{{--            url : $(this).attr("action"),--}}
{{--            type: $(this).attr("method"),--}}
{{--            data : $(this).serialize()--}}
{{--        }).done(function(response){--}}

{{--            if(response == 200){--}}
{{--                $('#modal_schedule_times').modal('toggle');--}}
{{--                tableRefresh();--}}
{{--                swal(--}}
{{--                    "Completado",--}}
{{--                    "Se asigno correctamente las fechas de inicio y fin del mes de "+ mes +"  para la  "  + name,--}}
{{--                    "success"--}}
{{--                );--}}
{{--                $('#modal_schedule_times').modal('toggle');--}}
{{--                $('#enviar').attr('disabled',false);--}}
{{--                Ladda.stopAll();--}}
{{--            }--}}
{{--            else if(response == 500) {--}}
{{--                $('#modal_schedule_times .modal-body .alert').css('display','block');--}}
{{--                $("#modal_schedule_times .modal-body .errors").empty();--}}
{{--                $('<li/>')--}}
{{--                    .addClass('ui-menu-item')--}}
{{--                    .attr('role', 'menuitem')--}}
{{--                    .appendTo('#modal_schedule_times .modal-body .errors')--}}
{{--                    .text('Las fecha Fin no puede coincidir o ser menor a la de Inicio');--}}
{{--                $('#enviar').attr('disabled',false);--}}
{{--                Ladda.stopAll();--}}
{{--                return false;--}}
{{--            }--}}
{{--            else{--}}
{{--                $('#modal_schedule_times .modal-body .alert').css('display','block');--}}
{{--                $("#modal_schedule_times .modal-body .errors").empty();--}}
{{--                $('<li/>')--}}
{{--                    .addClass('ui-menu-item')--}}
{{--                    .attr('role', 'menuitem')--}}
{{--                    .appendTo('#modal_schedule_times .modal-body .errors')--}}
{{--                    .text('Ingresar fecha con año actual');--}}
{{--                $('#enviar').attr('disabled',false);--}}
{{--                Ladda.stopAll();--}}
{{--                return false;--}}
{{--            }--}}
{{--        }).fail(function (error) {--}}
{{--            var obj = error.responseJSON;--}}
{{--            $('#modal_schedule_times .modal-body .alert').css('display','block');--}}
{{--            $("#modal_schedule_times .modal-body .errors").empty();--}}
{{--            $.each(obj.errors, function(index, value)--}}
{{--            {--}}
{{--                $('<li/>')--}}
{{--                    .addClass('ui-menu-item')--}}
{{--                    .attr('role', 'menuitem')--}}
{{--                    .appendTo('#modal_schedule_times .modal-body .errors')--}}
{{--                    .text(value);--}}
{{--            });--}}
{{--            Ladda.stopAll();--}}
{{--            $('#enviar').attr('disabled',false);--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}

<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonoAlemanController extends HomeController
{
    private $VAN = 0.00;


//    public function createUser(Request $request)
//    {
//        dd(123);
//        $entity = [
//            'name' => $request->name,
//            'username' => $request->username,
//            'paternalSurname' => $request->paternalSurname,
//            'maternalSurname' => $request->maternalSurname,
//            'dni' => $request->dni,
//            'email' => $request->email,
//            'password' => bcrypt($request->password),
//            'email_verified_at' => true,
//        ];
//        $result = User::create($entity);
//
//        dd($result);
//        return url("login");
//    }

    public function index()
    {
        return view('pages.bonos');
    }

    public function FlujoEmisorP0($vComercial,$costosInicialesEmisor)
    {
        return $vComercial - $costosInicialesEmisor;
    }

    public function FlujoEmisorP($iteracion,$nroTotalPeriodos,$cuota,$prima)
    {
        if($iteracion <= $nroTotalPeriodos)
            $flujoEmisor = $cuota + $prima;
        else
            $flujoEmisor = 0;

        return $flujoEmisor;
    }

    public function FlujoBonistaP0($vComercial,$costosInicialesBonista)
    {
        return  -$vComercial - $costosInicialesBonista;
    }

    public function FechaProgramadaP($fechaInicial,$frecuenciaDelCupon)
    {
        $frechaProgramada = Carbon::createFromFormat('d/m/Y', $fechaInicial);
        $frechaProgramada = $frechaProgramada->addDays($frecuenciaDelCupon)->format("d/m/Y");
        return $frechaProgramada;
    }

    public function InflacionDelPeriodo($iteracion,$nroTotalPeriodos,$inflacionAnual,$frecuenciaCupon,$diasXAnio)
    {
        if($iteracion <= $nroTotalPeriodos)
            $valor = pow((1 + $inflacionAnual), ($frecuenciaCupon/$diasXAnio)) - 1;
        else
            $valor = 0;

        return $valor*100;
    }

    public function BonoIndexado($bono,$InflacionDelPeriodo)
    {
        return $bono*(1+$InflacionDelPeriodo);
    }

    public function CuponInteres($bonoIndexado,$tasaEfectivaPeriodo)
    {
        return -$bonoIndexado*($tasaEfectivaPeriodo/100);
    }

    public function Cuota($iteracion,$nroTotalPeriodos,$plazoGracia,$cuponInteres,$amortizacion)
    {
        $map = [
            "T" => 0,
            "P" => $cuponInteres,
            "S" => $cuponInteres + $amortizacion,
        ];

        if($iteracion <= $nroTotalPeriodos)
            $cuota = $map[$plazoGracia];
        else
            $cuota = 0;

        return $cuota;
    }

    public function Amortizacion($iteracion,$nroTotalPeriodos,$plazoGracia,$bonoIndexado)
    {
        if($iteracion <= $nroTotalPeriodos){
            if($plazoGracia == "T" || $plazoGracia == "P")
                $amortizacion = 0;
            else
                $amortizacion = (-$bonoIndexado/($nroTotalPeriodos-$iteracion+1));
        }
        else
            $amortizacion = 0;

        return $amortizacion;
    }

    public function Bono($iteracion, $vNominal, $nroTotalPeriodos, $plazoDeGracia, $bonoIndexado,$cuponInteres,$amortizacion)
    {
        if($iteracion == 1){
            $bono = $vNominal;
        }
        else if($iteracion <= $nroTotalPeriodos){
            if($plazoDeGracia == "T"){
                $bono = $bonoIndexado - $cuponInteres;
            }
            else{
                $bono = $bonoIndexado + $amortizacion;
            }
        }
        else{
            $bono = 0;
        }

        return $bono;
    }

    public function Prima($iteracion,$nroTotalPeriodos,$primaEntrada,$vNominal)
    {
        if($iteracion == $nroTotalPeriodos)
            $prima = $this->convertDecimal((($primaEntrada*$vNominal)/100));
        else
            $prima = 0;

        return $prima*(-1);
    }

    public function Escudo($cupon,$impRenta)
    {
        return (-$cupon*($impRenta/100));
    }

    public function algoritmoVAN($flujoBonista,$COK,$iteracion)
    {
        $this->VAN = $this->VAN + ($flujoBonista/pow((1+($COK/100)),$iteracion));
        return $this->VAN;
    }

    public function algoritmoTIR($planDePagos,$tipo)
    {
        $TIR = null;
        for($N=1; $N <= 100; $N+=0.01)
        {
            $VAN = 0.00;

            for($M = 1; $M <= count($planDePagos)-1; $M++)
                $VAN = $VAN + (abs($planDePagos[$M][$tipo])/pow((1+($N/100)),$M));

            if("flujoBonista" == $tipo)
                $flujoInicial = $planDePagos[0][$tipo]*-1;
            else
                $flujoInicial = $planDePagos[0][$tipo];

            $VAN = -$flujoInicial + $VAN;

            if($VAN <= 0){
                $TIR = $N;
                break;
            }
        }

        return $TIR;
    }

    public function TCEA_TREA($TIR,$diasXAnio,$frecuenciaCupon)
    {
        $result = pow((1+($TIR/100)),($diasXAnio/$frecuenciaCupon)) - 1;
        return $this->convertDecimal($result*100);
    }


    public function FlujoDePagos(Request $request)
    {
        try
        {
            $nAnios = is_null($request->nAnios) ? 1 : $request->nAnios;
            $tasaInteres = is_null($request->tasaInteres) ? 0.00 : ($request->tasaInteres/100);

            $frecuenciaCupon = $request->frecuenciaCupon;

            if($request->tipo_tasa_interes == "N")
                $diasCapitalizacion = $request->capitalizacion;
            else
                $diasCapitalizacion = null;

            $nroPeriodoXAnio = $request->dias_x_anios / $frecuenciaCupon;

            $nroTotalPeriodo = $nroPeriodoXAnio * $nAnios;

            if($request->tipo_tasa_interes == "E")
            {
                $TEA = $this->convertDecimal($tasaInteres*100);
            }
            else
            {
                $calculoDias = $request->dias_x_anios / $diasCapitalizacion;

                $TEA = pow((1 + ($tasaInteres / $calculoDias)),$calculoDias) - 1;
                $TEA = $this->convertDecimal($TEA*100);
            }

            $tasaEfectivaPeriodo = pow((1+($TEA/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
            $tasaEfectivaPeriodo = $this->convertDecimal($tasaEfectivaPeriodo*100);

            $COK = pow((1+($request->tasa_anual_descuento/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
            $COK = $this->convertDecimal($COK*100);

            $costesInicialesEmisor = (($request->estructuracion/100) + ($request->colocacion/100) + ($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;
            $costesInicialesBonista = (($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;



            $planDePagos = [];

            for($i = 0; $i <= $nroTotalPeriodo; $i++)
            {
                $periodo = [];
                if($i == 0){
                    $periodo["n"] = $i;
                    $periodo["fechaProgramada"] = $request->fechaEmisionBono;
                    $periodo["inflacionAnual"] = 0.00;
                    $periodo["inflacionDelPeriodo"] = 0.00;
                    $periodo["plazoDeGracia"] = 0.00;
                    $periodo["bono"] = 0.00;
                    $periodo["bonoIndexado"] = 0.00;
                    $periodo["cuponInteres"] = 0.00;
                    $periodo["cuota"] = 0.00;
                    $periodo["amortizacion"] = 0.00;
                    $periodo["prima"] = 0.00;
                    $periodo["escudo"] = 0.00;
                    $periodo["flujoEmisor"] = $this->convertDecimal($this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor));
                    $periodo["flujoEmisorConEscudo"] = $this->convertDecimal($this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor));
                    $periodo["flujoBonista"] = $this->convertDecimal($this->FlujoBonistaP0($request->vComercial,$costesInicialesBonista));
                }
                else{
                    $periodo["n"] = $i;
                    $periodo["fechaProgramada"] = $this->FechaProgramadaP($planDePagos[$i-1]["fechaProgramada"],$frecuenciaCupon);
                    $periodo["inflacionAnual"] = 0.00/100;
                    $periodo["inflacionDelPeriodo"] = $this->convertDecimal($this->InflacionDelPeriodo($i,$nroTotalPeriodo,(0.00/100),$frecuenciaCupon,$request->dias_x_anios));
                    $periodo["plazoDeGracia"] = "S";
                    $periodo["bono"] = $this->convertDecimal($this->Bono($i,$request->vNominal,$nroTotalPeriodo,$planDePagos[$i-1]["plazoDeGracia"],$planDePagos[$i-1]["bonoIndexado"],$planDePagos[$i-1]["cuponInteres"],$planDePagos[$i-1]["amortizacion"]));
                    $periodo["amortizacion"] = $this->convertDecimal($this->Amortizacion($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"])));
                    $periodo["bonoIndexado"] = $this->convertDecimal($this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"]));
                    $periodo["cuponInteres"] = $this->convertDecimal($this->CuponInteres($periodo["bonoIndexado"],$tasaEfectivaPeriodo));
                    $periodo["cuota"] = $this->convertDecimal($this->Cuota($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$periodo["cuponInteres"],$periodo["amortizacion"]));
                    $periodo["prima"] = $this->Prima($i,$nroTotalPeriodo,$request->prima,$request->vNominal);
                    $periodo["escudo"] = $this->convertDecimal($this->Escudo($periodo["cuponInteres"],$request->impRenta));
                    $periodo["flujoEmisor"] = $this->convertDecimal($this->FlujoEmisorP($i,$nroTotalPeriodo,$periodo["cuota"],$periodo["prima"]));
                    $periodo["flujoEmisorConEscudo"] = $this->convertDecimal($periodo["flujoEmisor"] + $periodo["escudo"]);
                    $periodo["flujoBonista"] = -$this->convertDecimal($periodo["flujoEmisor"]);
                    $this->algoritmoVAN($periodo["flujoBonista"],$COK,$i);
                }
                array_push($planDePagos,$periodo);

            }
            return response()->json(["data" => $planDePagos]);
        }
        catch (\Exception $e)
        {
            return response()->json(["data" => []]);
        }
    }

    public function DatosDeSalida(Request $request)
    {
        try
        {
            $nAnios = is_null($request->nAnios) ? 1 : $request->nAnios;
            $tasaInteres = is_null($request->tasaInteres) ? 0.00 : ($request->tasaInteres/100);

            $frecuenciaCupon = $request->frecuenciaCupon;

            if($request->tipo_tasa_interes == "N")
                $diasCapitalizacion = $request->capitalizacion;
            else
                $diasCapitalizacion = null;

            $nroPeriodoXAnio = $request->dias_x_anios / $frecuenciaCupon;

            $nroTotalPeriodo = $nroPeriodoXAnio * $nAnios;

            if($request->tipo_tasa_interes == "E")
            {
                $TEA = $this->convertDecimal($tasaInteres*100);
            }
            else
            {
                $calculoDias = $request->dias_x_anios / $diasCapitalizacion;

                $TEA = pow((1 + ($tasaInteres / $calculoDias)),$calculoDias) - 1;
                $TEA = $this->convertDecimal($TEA*100);
            }

            $tasaEfectivaPeriodo = pow((1+($TEA/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
            $tasaEfectivaPeriodo = $this->convertDecimal($tasaEfectivaPeriodo*100);

            $COK = pow((1+($request->tasa_anual_descuento/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
            $COK = $this->convertDecimal($COK*100);

            $costesInicialesEmisor = (($request->estructuracion/100) + ($request->colocacion/100) + ($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;
            $costesInicialesBonista = (($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;



            $planDePagos = [];

            for($i = 0; $i <= $nroTotalPeriodo; $i++)
            {
                $periodo = [];
                if($i == 0){
                    $periodo["n"] = $i;
                    $periodo["fechaProgramada"] = $request->fechaEmisionBono;
                    $periodo["inflacionAnual"] = 0.00;
                    $periodo["inflacionDelPeriodo"] = 0.00;
                    $periodo["plazoDeGracia"] = 0.00;
                    $periodo["bono"] = 0.00;
                    $periodo["bonoIndexado"] = 0.00;
                    $periodo["cuponInteres"] = 0.00;
                    $periodo["cuota"] = 0.00;
                    $periodo["amortizacion"] = 0.00;
                    $periodo["prima"] = 0.00;
                    $periodo["escudo"] = 0.00;
                    $periodo["flujoEmisor"] = $this->convertDecimal($this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor));
                    $periodo["flujoEmisorConEscudo"] = $this->convertDecimal($this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor));
                    $periodo["flujoBonista"] = $this->convertDecimal($this->FlujoBonistaP0($request->vComercial,$costesInicialesBonista));
                }
                else{
                    $periodo["n"] = $i;
                    $periodo["fechaProgramada"] = $this->FechaProgramadaP($planDePagos[$i-1]["fechaProgramada"],$frecuenciaCupon);
                    $periodo["inflacionAnual"] = 0.00/100;
                    $periodo["inflacionDelPeriodo"] = $this->convertDecimal($this->InflacionDelPeriodo($i,$nroTotalPeriodo,(0.00/100),$frecuenciaCupon,$request->dias_x_anios));
                    $periodo["plazoDeGracia"] = "S";
                    $periodo["bono"] = $this->convertDecimal($this->Bono($i,$request->vNominal,$nroTotalPeriodo,$planDePagos[$i-1]["plazoDeGracia"],$planDePagos[$i-1]["bonoIndexado"],$planDePagos[$i-1]["cuponInteres"],$planDePagos[$i-1]["amortizacion"]));
                    $periodo["amortizacion"] = $this->convertDecimal($this->Amortizacion($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"])));
                    $periodo["bonoIndexado"] = $this->convertDecimal($this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"]));
                    $periodo["cuponInteres"] = $this->convertDecimal($this->CuponInteres($periodo["bonoIndexado"],$tasaEfectivaPeriodo));
                    $periodo["cuota"] = $this->convertDecimal($this->Cuota($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$periodo["cuponInteres"],$periodo["amortizacion"]));
                    $periodo["prima"] = $this->Prima($i,$nroTotalPeriodo,$request->prima,$request->vNominal);
                    $periodo["escudo"] = $this->convertDecimal($this->Escudo($periodo["cuponInteres"],$request->impRenta));
                    $periodo["flujoEmisor"] = $this->convertDecimal($this->FlujoEmisorP($i,$nroTotalPeriodo,$periodo["cuota"],$periodo["prima"]));
                    $periodo["flujoEmisorConEscudo"] = $this->convertDecimal($periodo["flujoEmisor"] + $periodo["escudo"]);
                    $periodo["flujoBonista"] = -$this->convertDecimal($periodo["flujoEmisor"]);
                    $this->algoritmoVAN($periodo["flujoBonista"],$COK,$i);
                }
                array_push($planDePagos,$periodo);

            }

            $VAN = $this->VAN;
            $utilidadPerdida = $this->FlujoBonistaP0($request->vComercial,$costesInicialesBonista) + $VAN;



            $TCEAEmisor = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoEmisor"),$request->dias_x_anios,$frecuenciaCupon);
            $TCEAEmisorEscudo = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoEmisorConEscudo"),$request->dias_x_anios,$frecuenciaCupon);
            $TCEABonista = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoBonista"),$request->dias_x_anios,$frecuenciaCupon);


            $result = [
                "FrecuenciaCupon" => $frecuenciaCupon,
                "DiasCapitalizacion" => $diasCapitalizacion,
                "NPeriodosAnio" => $nroPeriodoXAnio,
                "NTotalPeriodos" => $nroTotalPeriodo,
                "TEA" => $TEA,
                "TEP" => $tasaEfectivaPeriodo,
                "COK" => $COK,
                "CostesInicialesEmisor" => $this->convertDecimal($costesInicialesEmisor),
                "CostesInicialesBonista" => $this->convertDecimal($costesInicialesBonista),
                "PrecioActual" => $this->convertDecimal($VAN),
                "UtilidadPerdida" => $this->convertDecimal($utilidadPerdida),
                "TCEAEmisor" => $this->convertDecimal($TCEAEmisor),
                "TCEAEmisorEscudo" => $this->convertDecimal($TCEAEmisorEscudo),
                "TREABonista" => $this->convertDecimal($TCEABonista)
            ];

            return response()->json(["data" => $result]);
        }
        catch (\Exception $e)
        {
            return response()->json(["data" => $e->getMessage()."- - -".$e->getLine()]);
        }
    }

    public function calcular(Request $request)
    {
       try{
           $nAnios = is_null($request->nAnios) ? 1 : $request->nAnios;
           $tasaInteres = is_null($request->tasaInteres) ? 0.00 : ($request->tasaInteres/100);

           $frecuenciaCupon = $request->frecuenciaCupon;

           if($request->tipo_tasa_interes == "N")
               $diasCapitalizacion = $request->capitalizacion;
           else
               $diasCapitalizacion = null;

           $nroPeriodoXAnio = $request->dias_x_anios / $frecuenciaCupon;

           $nroTotalPeriodo = $nroPeriodoXAnio * $nAnios;

           if($request->tipo_tasa_interes == "E")
           {
               $TEA = number_format($tasaInteres*100,4,'.','');
           }
           else
           {
               $calculoDias = $request->dias_x_anios / $diasCapitalizacion;

               $TEA = pow((1 + ($tasaInteres / $calculoDias)),$calculoDias) - 1;
               $TEA = number_format($TEA*100,4,'.','');
           }

           $tasaEfectivaPeriodo = pow((1+($TEA/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
           $tasaEfectivaPeriodo = number_format($tasaEfectivaPeriodo*100,4,'.','');

           $COK = pow((1+($request->tasa_anual_descuento/100)),($frecuenciaCupon/$request->dias_x_anios)) - 1;
           $COK = number_format($COK*100,4,'.','');

           $costesInicialesEmisor = (($request->estructuracion/100) + ($request->colocacion/100) + ($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;
           $costesInicialesBonista = (($request->flotacion/100) + ($request->cavali/100))*$request->vComercial;



           $planDePagos = [];

           for($i = 0; $i <= $nroTotalPeriodo; $i++)
           {
               $periodo = [];
               if($i == 0){
                   $periodo["fechaProgramada"] = $request->fechaEmisionBono;
                   $periodo["inflacionAnual"] = null;
                   $periodo["inflacionDelPeriodo"] = null;
                   $periodo["plazoDeGracia"] = null;
                   $periodo["bono"] = null;
                   $periodo["bonoIndexado"] = null;
                   $periodo["cuponInteres"] = null;
                   $periodo["cuota"] = null;
                   $periodo["amortizacion"] = null;
                   $periodo["prima"] = null;
                   $periodo["escudo"] = null;
                   $periodo["flujoEmisor"] = $this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor);
                   $periodo["flujoEmisorConEscudo"] = $this->FlujoEmisorP0($request->vComercial,$costesInicialesEmisor);
                   $periodo["flujoBonista"] = $this->FlujoBonistaP0($request->vComercial,$costesInicialesBonista);
               }
               else{
                   $periodo["fechaProgramada"] = $this->FechaProgramadaP($planDePagos[$i-1]["fechaProgramada"],$frecuenciaCupon);
                   $periodo["inflacionAnual"] = 0.00/100;
                   $periodo["inflacionDelPeriodo"] = $this->InflacionDelPeriodo($i,$nroTotalPeriodo,(0.00/100),$frecuenciaCupon,$request->dias_x_anios);
                   $periodo["plazoDeGracia"] = "S";
                   $periodo["bono"] = $this->Bono($i,$request->vNominal,$nroTotalPeriodo,$planDePagos[$i-1]["plazoDeGracia"],$planDePagos[$i-1]["bonoIndexado"],$planDePagos[$i-1]["cuponInteres"],$planDePagos[$i-1]["amortizacion"]);
                   $periodo["amortizacion"] = $this->Amortizacion($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"]));
                   $periodo["bonoIndexado"] = $this->BonoIndexado($periodo["bono"],$periodo["inflacionDelPeriodo"]);
                   $periodo["cuponInteres"] = $this->CuponInteres($periodo["bonoIndexado"],$tasaEfectivaPeriodo);
                   $periodo["cuota"] = $this->Cuota($i,$nroTotalPeriodo,$periodo["plazoDeGracia"],$periodo["cuponInteres"],$periodo["amortizacion"]);
                   $periodo["prima"] = $this->Prima($i,$nroTotalPeriodo,$request->prima,$request->vNominal);
                   $periodo["escudo"] = $this->Escudo($periodo["cuponInteres"],$request->impRenta);
                   $periodo["flujoEmisor"] = $this->FlujoEmisorP($i,$nroTotalPeriodo,$periodo["cuota"],$periodo["prima"]);
                   $periodo["flujoEmisorConEscudo"] = $periodo["flujoEmisor"] + $periodo["escudo"];
                   $periodo["flujoBonista"] = -$periodo["flujoEmisor"];
                   $this->algoritmoVAN($periodo["flujoBonista"],$COK,$i);
               }
               array_push($planDePagos,$periodo);
           }




           $VAN = $this->VAN;
           $utilidadPerdida = $this->FlujoBonistaP0($request->vComercial,$costesInicialesBonista) + $VAN;



           $TCEAEmisor = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoEmisor"),$request->dias_x_anios,$frecuenciaCupon);
           $TCEAEmisorEscudo = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoEmisorConEscudo"),$request->dias_x_anios,$frecuenciaCupon);
           $TCEABonista = $this->TCEA_TREA($this->algoritmoTIR($planDePagos,"flujoBonista"),$request->dias_x_anios,$frecuenciaCupon);


           $result = [
               "DATOS" => $request->all(),
               "Frecuencia del cupón" => $frecuenciaCupon,
               "Días capitalización" => $diasCapitalizacion,
               "Nº Períodos por Año" => $nroPeriodoXAnio,
               "Nº Total de Periodos" => $nroTotalPeriodo,
               "Tasa efectiva anual (TEA)" => $TEA,
               "Tasa efectiva del Periodo (semestral,...)" => $tasaEfectivaPeriodo,
               "COK" => $COK,
               "Costes Iniciales Emisor" => $costesInicialesEmisor,
               "Costes Iniciales Bonista" => $costesInicialesBonista,
               "Precio Actual" => $VAN,
               "Utilidad / Pérdida" => $utilidadPerdida,
               "TCEA Emisor" => $TCEAEmisor,
               "TCEA Emisor c/Escudo" => $TCEAEmisorEscudo,
               "TREA Bonista" => $TCEABonista,
               "PLAN DE PAGOS" => $planDePagos,
           ];



           Bond::create([
               "typeOfCurrency" => $request->frecuenciaCupon,
               "nominalValue" => $request->vNominal,
               "commercialValue" => $request->vComercial,
               "year" => $request->nAnios,
               "paymentFrequency" => $request->frecuenciaCupon,
               "exact" => 1,
               "capitalization" => $request->capitalizacion,
               "interestRate" => $request->tasaInteres,
               "annualDiscountRate" => $request->dias_x_anios,
               "user_id" => Auth::user()->id,
           ]);

           return redirect("calcular_bono");
       }
       catch (\Exception $e)
       {
           return redirect("calcular_bono");
       }

    }
}

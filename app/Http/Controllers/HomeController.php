<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function prueba()
    {
        return view('layouts.prueba');
    }

    public function GetArrayDataTable($DataTable)
    {
        $query = explode("&",parse_url($DataTable)["path"]);
        $list = array();
        foreach( $query as $val ){
            $tmp = explode( '=', $val );
            $list[ $tmp[0] ] = $tmp[1];
        }

        return $list;
    }

    public function GetDataTableSortOrder($var)
    {
        return array_key_exists(config("constants.DATATABLE_SERVER_SIDE_PARAMETERS.SORT_ORDER"),$var)
            ?  $var[config("constants.DATATABLE_SERVER_SIDE_PARAMETERS")]
            : null;
    }

    public function GetDataTableSortField($var)
    {
        return array_key_exists(config("constants.DATATABLE_SERVER_SIDE_PARAMETERS.SORT_FIELD"),$var)
            ?  $var[config("constants.DATATABLE_SERVER_SIDE_PARAMETERS")]
            : null;
    }

    public function GetDataTableCurrentNumber($var)
    {
        return $var[config("constants.DATATABLE_SERVER_SIDE_PARAMETERS.START")];
    }

    public function GetDataTableRecordsPerPage($var)
    {
        return $var[config("constants.DATATABLE_SERVER_SIDE_PARAMETERS.PAGE_PER_PAGE")];
    }

    public function GetDataTablePaginationObjet($filters,$pageList,$draw)
    {
        return [
            "draw" => $draw,
            "recordsTotal" => $filters,
            "recordsFiltered" => $filters,
            "data" => $pageList
        ];
    }

    public function convertDecimal($number)
    {
        return number_format($number,3,'.','');
    }

    public function Ok()
    {
        return 200;
    }
}


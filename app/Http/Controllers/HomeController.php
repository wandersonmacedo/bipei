<?php

namespace App\Http\Controllers;

use App\Helpers\Rastreio;
use App\Models\CodigoRastreio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {

        $codRastreiobyData = new CodigoRastreio();
        $arrayCod = $codRastreiobyData->getCodigoRastreioByDate(false);
        $arrayCod["DataCadastro"] = date('Y-m-d');
        if(!empty($_GET['data_cadastro'])){
            $arrayCod["DataCadastro"] = $_GET['data_cadastro'];
            $arrayCod["sele"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$_GET['data_cadastro'])->get();
            $arrayCod["seleCount"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$_GET['data_cadastro'])->count();
        }
        else{
            $arrayCod["sele"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$arrayCod["DataCadastro"],date('Y-m-d')])->get();
            $arrayCod["seleCount"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$arrayCod["DataCadastro"],date('Y-m-d')])->count();
        }
        $arrayCod["getDistinctDate"] = $codRastreiobyData->getDistinctDate();
        $arrayCod["all"] = CodigoRastreio::where('user_id',Auth::id())->get();
      // dd($arrayCod);
        return view('home')->with('codRastreioByDate',$arrayCod);
    }
}

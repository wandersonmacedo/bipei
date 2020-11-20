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
        $arrayCod["DataCadastro"] = date('Y-m-d');
        if($request->get('data_cadastro')){
            $arrayCod["selectBeetween"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$request->get('data_cadastro'))->get();
            $arrayCod["DataCadastro"] = $request->get('data_cadastro');
        }
        else{
            $arrayCod["selectBeetween"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$arrayCod["DataCadastro"],date('Y-m-d')])->get();
        }
        $codRastreiobyData = new CodigoRastreio();
        $arrayCod = $codRastreiobyData->getCodigoRastreioByDate(false);
        $arrayCod["getDistinctDate"] = $codRastreiobyData->getDistinctDate();
        $arrayCod["all"] = CodigoRastreio::where('user_id',Auth::id())->get();
       $tes = new Rastreio();
     var_dump($tes->get('OL453785791BR'));
        return view('home')->with('codRastreioByDate',$arrayCod);
    }
}

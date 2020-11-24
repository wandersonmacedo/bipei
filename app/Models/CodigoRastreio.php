<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class CodigoRastreio extends Model
{
    protected $table = "codigo_rastreio";
    protected $fillable = ["cod_rastreio", "data_cadastro", "hora_cadastro","user_id"];

    public function getCodigoRastreioByDate($request){
        $returnArray = [];
        $data_hoje = date('Y-m-d');
        $data_ontem = date('Y-m-d', strtotime($data_hoje . ' - 1 days'));
        $data_7dias = date('Y-m-d', strtotime($data_hoje . ' - 7 days'));
        $data_30dias = date('Y-m-d', strtotime($data_hoje . ' - 30 days'));
        $returnArray["qntd_hoje"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$data_hoje)->count();
        $returnArray["qntd_ontem"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$data_ontem)->count();
        $returnArray["qntd_7dias"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$data_7dias,date('Y-m-d')])->count();
        $returnArray["qntd_30dias"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$data_30dias,date('Y-m-d')])->count();
        if ($_GET) {
            $returnArray["DataCadastro"] = $_GET['data_cadastro'];
        } else {
            $returnArray["DataCadastro"] = date('Y-m-d');
        }
        if ( $returnArray["DataCadastro"]) {

            $returnArray["qntd_rastreios"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$data_hoje)->count();
        }
        return $returnArray;
    }

    public function getDistinctDate()
    {
        return CodigoRastreio::select('data_cadastro')->where('user_id',Auth::id())->distinct()->orderBy('data_cadastro','DESC')->get();
    }

    public function getDistinctDateByDay()
    {
        return DB::table('codigo_rastreio')->select("data_cadastro")->distinct('data_cadastro')->where('user_id',Auth::id())->orderBy('data_cadastro','desc')->get();
    }
    public function getDistinctDateByMonth()
    {
        return DB::table('codigo_rastreio')->select(DB::raw("DATE_FORMAT(data_cadastro, '%Y-%m') data_cadastro"))->distinct('data_cadastro')->where('user_id',Auth::id())->get();
    }

}

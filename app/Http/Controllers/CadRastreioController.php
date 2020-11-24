<?php


namespace App\Http\Controllers;


use App\Models\CodigoRastreio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CadRastreioController extends Controller
{

    public function index()
    {
        return view('cadastro/cadastrar')->with('codRastreio',CodigoRastreio::where('user_id',Auth::id())->orderBy('data_cadastro','desc')->take(5)->get());
    }

    public function remove($id)
    {
        CodigoRastreio::where('id',$id)->delete();
        return $this->index();
    }

    public function exportar(Request $request)
    {
        $qntd_rastreios_dia = 0;
        $date = date('Y-m-d');
        if($request->get('data_cadastro')){
            $DataCadastro = $request->get('data_cadastro');
            $arrayInfo["selectBeetween"] = CodigoRastreio::where('user_id',Auth::id())->where("data_cadastro",$request->get('data_cadastro'))->get();
        }
        else{
            $DataCadastro = date('Y-m-d');
            $arrayInfo["selectBeetween"] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$DataCadastro,date('Y-m-d')])->get();
        }

        $model = new CodigoRastreio();
        $arrayInfo["listRastreio"] = $model->getDistinctDateByDay();
        $arrayInfo["distData"] = $model->getDistinctDateByMonth();
        $arrayInfo["qntd_rastreios_dia"] = CodigoRastreio::where('user_id',Auth::id())->where('data_cadastro',date('Y-m-d'))->count();;
        $arrayInfo["DataCadastro"] = $DataCadastro;


        return view('exportar')->with('info',$arrayInfo);
    }

    public function exportarMes(Request $request){

        if (!empty($request->get('mes_inicio')) || !empty($request->get('mes_final')) ) {
            @$mes_inicio = $_GET['mes_inicio'];
            @$mes_final = $_GET['mes_final'];
        } else {
            $mes_inicio = date('Y-m-01');
            $mes_final = date('Y-m-d');
        }
        $codRas['consulta'] = CodigoRastreio::where('user_id',Auth::id())->whereBetween("data_cadastro",[$mes_inicio,$mes_final])->get();
        $codRas['qntd_rastreios_mes'] = count($codRas);
        $model = new CodigoRastreio();
        $codRas["listRastreio"] =  $model->getDistinctDateByDay();
        $codRas["distData"] = $model->getDistinctDateByMonth();
        $codRas["mes_inicio"] = $mes_inicio;
        $codRas["mes_final"] = $mes_final;
        return view('exportarMes')->with('consulta',$codRas);


    }

    public function buscar()
    {
        return view('busca')->with('info',CodigoRastreio::where('user_id',Auth::id())->get());
    }

    public function save(Request $request)
    {
        $horacadastro = date("H:i");
        $codrastreio = strtoupper($request->post('codrastreio'));
        $datacadastro = $request->post('datacadastro');

        $re = '/^[A-Z]{2}\d{9}[A-Z]{2}$/m';
        if (preg_match_all($re, $codrastreio, $matches, PREG_SET_ORDER, 0)) {
            if (CodigoRastreio::where('cod_rastreio',$codrastreio)->count() == 0) {

                if (CodigoRastreio::create([ "cod_rastreio" => $codrastreio, "data_cadastro" => $datacadastro, "hora_cadastro" => $horacadastro,"user_id" => Auth::id()])) {
                    return redirect('cadastrar')->with('success'," Código de rastreio " . $codrastreio . " cadastrado com sucesso! ");
                } else {
                    return redirect('cadastrar')->with('error'," Problema ao tentar salvar ! ");
                }
            } else {
                return redirect('cadastrar')->with('error', " Código de rastreio " . $codrastreio . " já cadastrado!");
            }
        } else {
            return redirect('cadastrar')->with('error'," Código de rastreio inválido!");
        }
    }

}

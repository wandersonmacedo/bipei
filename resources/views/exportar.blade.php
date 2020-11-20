@extends('layouts.app')
@section('content')
<body class="d-flex flex-column">
<div id="page-content">
    <div class="container">
        <div class="row mt-3">
            <form class="col-md-6 mt-1">
                <div class="form-group">
                    <select class="form-control font-weight-bold select_dia" onChange="window.location.href=this.value">
                        <option>Relatório diário:</option>
                        @if(!empty($info["listRastreio"]))
                            @foreach($info["listRastreio"] as $row)
                                <option value='{{route('exportar')}}?data_cadastro={{$row->data_cadastro}}'>{{\App\Helpers\Utils::formata_data($row->data_cadastro)}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </form>
            <form class="col-md-6 my-1">
                <div class="form-group">
                    <select class="form-control font-weight-bold select_mes" onChange="window.location.href=this.value">
                        <option>Relatório mensal: </option>

                        @if(!empty($info["distData"])) {
                            @foreach($info["distData"] as $row)
                                <option class='optSel' value='{{route('exportarMes')}}?mes_inicio={{$row->data_cadastro}}-01&mes_final={{$row->data_cadastro}}-31'>
                                    {{\App\Helpers\Utils::mes_atual($row->data_cadastro)}}
                                </option>";
                            @endforeach
                        @else
                            <tr><td colspan='5'><center>No Data Avaliable</center></td></tr>
                        @endif

                    </select>
                </div>
            </form>
        </div>
        <h5 class="mt-3 mb-3">Lista de rastreios <span class="dia_sel">{{\App\Helpers\Utils::formata_data($info["DataCadastro"])}}</span>
            <?php if($info["qntd_rastreios_dia"]==1) {?>
            - Total de <?php echo $info["qntd_rastreios_dia"];?> rastreio
            <?php }else if($info["qntd_rastreios_dia"]>1) { ?>
            - Total de <?php echo $info["qntd_rastreios_dia"];?> rastreios
            <?php } ?>
        </h5>
        <div class="box-table table-responsive load">
            <table class="codigosTable export table table-sm table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                <thead>
                <tr class="table-dark">
                    <th class="d-none">Id</th>
                    <th>Rastreio</th>
                    <th>Cadastro</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($info["selectBeetween"]))
                    @foreach($info["selectBeetween"] as $rows)
                        <tr>
                            <td class='d-none'>{{$rows['id']}}</td>
                            <td><span class='cod-rastreio font-weight-bolder text-uppercase'>{{$rows['cod_rastreio']}}</span></td>
                            <td>{{\App\Helpers\Utils::formata_data($rows['data_cadastro'])}}</td>
                            <td>{{$rows['hora_cadastro']}}</td>
                        </tr>
                    @endforeach
                @else
                    <script>
                        var element = document.getElementsByClassName('box-table')[0];
                        element.classList.remove('load');
                    </script>
                    <tr><td colspan='5'><center class='py-4 font-weight-bolder'>Não existem rastreios cadastrados nesta data.</center></td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div class="footer">
    <div class="container">
        <div class="col-12 py-4 text-center">
            <img src="images/logo-footer.svg" class="d-block mx-auto">
            <span class="text-muted">Powered by: <a href="http://efetive.com" target="blank">Efetive</a>  &copy; 2020</span>
        </div>
    </div>
</div>
<script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('js/buttons.flash.min.js')}}"></script>
<script src="{{url('js/jszip.min.js')}}"></script>
<script src="{{url('js/pdfmake.min.js')}}"></script>
<script src="{{url('js/vfs_fonts.js')}}"></script>
<script src="{{url('js/buttons.html5.min.js')}}"></script>
<script src="{{url('js/buttons.print.min.js')}}"></script>
<script src="{{url('js/_main.js')}}"></script>
</body>
</html>
@endsection

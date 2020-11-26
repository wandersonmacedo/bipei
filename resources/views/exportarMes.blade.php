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
                            @if(!empty($consulta["listRastreio"]))
                                @foreach($consulta["listRastreio"] as $row)
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

                            @if(!empty($consulta["distData"])) {
                            @foreach($consulta["distData"] as $row)
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

        <h5 class="mt-3 mb-3">Lista de rastreios <span class="mes_sel"><?php echo \App\Helpers\Utils::mes_atual(substr($consulta["mes_inicio"], 0, 7))?></span> - Total: <?php echo $consulta["qntd_rastreios_mes"] ?></h5>
        <div class="box-table table-responsive load">
            <table class="codigosTable export table table-sm table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                <thead>
                <tr class="table-dark">
                    <th class="d-none"><strong>ID</strong></th>
                    <th><strong>Rastreio</strong></th>
                    <th><strong>Data</strong></th>
                    <th><strong>Hora</strong></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($consulta["consulta"])) {
                    foreach($consulta["consulta"] as $row) {
                        echo "<tr><td class='d-none'>".$row['id']."</td>
											<td><span class='cod-rastreio font-weight-bolder text-uppercase'>".$row['cod_rastreio']."</span></td>
											<td><span>".\App\Helpers\Utils::formata_data($row['data_cadastro'])."</span></td>
											<td><span>".$row['hora_cadastro']."</span></td>
						</tr>";
                    }
                } else {
                    echo "<script> var element = document.getElementsByClassName('box-table')[0]; element.classList.remove('load'); </script>";
                    echo "<tr><td colspan='3'><center class='py-4 font-weight-bolder'>Não existem rastreios cadastrados nesta data.</center></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="col-12 py-4 text-center">
            <img src="{{url('images/logo-footer.svg')}}" class="d-block mx-auto">
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

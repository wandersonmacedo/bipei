@extends('layouts.app')

@section('content')
<body class="d-flex flex-column">
<div id="page-content">

    <div class="container">

        <div class="col-12 mb-4">
            <?php if(!$_GET){ ?>
            <div class="row mt-1 mb-2">
                <div class="col-sm-12 my-2 text-center content">
                    <div class="content-block py-2 py-md-4">
                        <h5>Hoje</h5>
                        <h4 class="badge badge-pill badge-primary">{{$codRastreioByDate["qntd_hoje"]}}</h4>
                        <svg width="8.5em" height="8.5em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/> </svg>
                    </div>
                </div>
                <div class="col-sm-4 my-2 text-center content">
                    <div class="content-block py-2 py-md-4">
                        <h5>Ontem</h5>
                        <h4 class="badge badge-pill badge-primary">{{$codRastreioByDate["qntd_ontem"]}}</h4>
                        <svg width="8.5em" height="8.5em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/> </svg>
                    </div>
                </div>
                <div class="col-sm-4 my-2 text-center content">
                    <div class="content-block py-2 py-md-4">
                        <h5>Últimos 7 dias</h5>
                        <h4 class="badge badge-pill badge-primary">{{$codRastreioByDate["qntd_7dias"]}}</h4>
                        <svg width="8.5em" height="8.5em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/> </svg>
                    </div>
                </div>
                <div class="col-sm-4 my-2 text-center content">
                    <div class="content-block py-2 py-md-4">
                        <h5>Últimos 30 dias</h5>
                        <h4 class="badge badge-pill badge-primary">{{$codRastreioByDate["qntd_30dias"]}}</h4>
                        <svg width="8.5em" height="8.5em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/> </svg>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($_GET){ ?>
            <h5 class="mt-3 mb-3">Lista de rastreios {{\App\Helpers\Utils::formata_data($codRastreioByDate["DataCadastro"])}} - Total de postagens: {{$codRastreioByDate["qntd_rastreios"]}}</h5>
            <?php } else { ?>
            <div class="row mb-3">
                <div class="col-md-8 my-2">
                   @if($codRastreioByDate["qntd_hoje"] == 0)
                       <h5>Não existem postagens hoje</h5>
                    @else
                        <h5>Lista de rastreios hoje - Total de postagens: {{$codRastreioByDate["qntd_hoje"]}}</h5>
                    @endif
                </div>
                <div class="col-md-4">
                    <a href="{{route('buscar')}}" class="btn btn-outline-primary btn-block float-md-right float-left font-weight-bolder"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/> <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/> </svg> Busca avançada</a>
                </div>
            </div>
            <?php } ?>
            <form>
                <div class="form-group">
                    <select class="form-control" onChange="window.location.href=this.value">
                        <option>Selecionar data:</option>]
                        @if(!empty($codRastreioByDate["getDistinctDate"]))
                            @foreach($codRastreioByDate["getDistinctDate"] as $codRastreioData)
                                <option value='?data_cadastro={{$codRastreioData->data_cadastro}}'>{{\App\Helpers\Utils::formata_data($codRastreioData->data_cadastro)}}</option>";
                            @endforeach
                        @endif
                    </select>
                </div>
            </form>
            <div class="box-table table-responsive load">
                <table class="codigosTable painel table table-sm table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                    <thead>
                    <tr class="table-dark">
                        <th class="d-none">Id</th>
                        <th>Rastreio</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($codRastreioByDate["all"]))
                        @foreach($codRastreioByDate["all"] as $row)
                            <tr>
                                <td class='d-none'>{{$row['id']}}</td>
                                <td><span class='cod-rastreio font-weight-bolder text-uppercase'>{{$row['cod_rastreio']}}</span></td>
                                <td>{{\App\Helpers\Utils::formata_data($row['data_cadastro'])}}</td>
                                <td>{{$row['hora_cadastro']}}</td>
                                <td class='text-center'>
                                        <button type='button' class='btn btn-primary btn-sm btn-remove' data-toggle='modal' data-target='#removeId{{$row['id']}}' data-rastreio='{{$row['cod_rastreio']}}'>
                                        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'> <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/> </svg>
                                        </button>
                                </td>
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
<div class='modal fade' id='modalId' data-backdrop='static' data-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title rastreio-info'></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <h6>Confirma a exclusão do Rastreio: <span class="rastreio-info"></span>?</h6>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-outline-secondary btn-sm' data-dismiss='modal'>Cancelar</button>
                <a href='#' class='btn btn-outline-danger btn-confirmation btn-sm'>Confirmar</a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('js/_main.js') }}"></script>
</html>
@endsection

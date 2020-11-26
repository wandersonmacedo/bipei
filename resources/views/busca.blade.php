@extends('layouts.app')
@section('content')
<body class="d-flex flex-column">
<div id="page-content">
    <div class="container">

        <div class="col-12 mb-4">

            <h5 class="mt-3 mb-3">Lista total de rastreios: <?php echo count($info);?></h5>

            <div class="box-table table-responsive load">
                <table class="codigosTable painel table table-sm table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                    <thead>
                    <tr class="table-dark">
                        <th class="d-none">Id</th>
                        <th>Rastreio</th>
                        <th>Cadastro</th>
                        <th>Data</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($info))
                        @foreach($info as $row)
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
                        </script>";
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
            <span class="text-muted">Powered by: <a href="https://efetive.com" target="blank">Efetive</a>  &copy; 2020</span>
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
<script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('js/_main.js')}}"></script>
</html>
@endsection

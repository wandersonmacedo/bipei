@extends('layouts.app')

@section('content')
<body class="d-flex flex-column">

<div id="page-content">
    <div class="container">
        @if(!empty(session('error')))
            <div class='alert alert-danger' role='alert'><strong>Erro:</strong>{{session('error')}}</div>
        @endif
        @if(!empty(session('success')))
                <div class='alert alert-success' role='alert'>{{session('success')}}</div>
        @endif
        <div class="col-12">
            <h5 class="mt-3">Cadastrar Rastreio:</h5>

            <form class="form-inline" action="{{route('cadastrarCodRastreio')}}" method="post">
                @csrf
                <div class="form-group mr-2 mb-2">
                    <input type="text" class="form-control text-uppercase " name="codrastreio" maxlength="13" id="codrast" autofocus required>
                    <input type="hidden" class="form-control" name="datacadastro" value="{{date("Y-m-d")}}" >
                </div>
                <button type="submit" class="btn btn-primary btn-md mb-2"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/> <path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/> </svg> <strong>Cadastrar</strong></button>
            </form>
            <h5 class="mt-3">Últimos cadastros:</h5>
            <table class='table table-sm'>
                <thead>
                <tr class="table-dark">
                    <th>Rastreio</th>
                    <th>Cadastro</th>
                    <th>Hora</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($codRastreio))

                    @foreach($codRastreio as $row)
                        <tr>
                            <td><span class='cod-rastreio font-weight-bolder text-uppercase'>{{$row['cod_rastreio']}}</span></td>
                            <td>{{$row['data_cadastro']}}</td>
                            <td>{{$row['hora_cadastro']}}</td>
                            <td class='text-center'>
                                    <button type='button' class='btn btn-primary btn-sm btn-remove' data-toggle='modal' data-target='#removeId{{$row['id']}}' data-rastreio='{{$row['cod_rastreio']}}'>
                                        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'> <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/> </svg>
                                    </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan='5'><center class='font-weight-bolder'>No Data Avaliable</center></td></tr>
                @endif
                </tbody>
            </table>
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
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/_main.js"></script>
</body>
</html>

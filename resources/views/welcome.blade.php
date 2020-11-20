<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <meta http-equiv="Content-Language" content="pt-BR" />
        <!-- Styles -->
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/main.css') }}" rel="stylesheet">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body class="login d-flex align-items-center">


                <div class="container">
                    <img src="{{url('images/logo-login.svg')}}" class="d-block mx-auto">
                    <div class="col-sm-8 offset-sm-2 col-md-4 offset-md-4 mt-2 mb-5 py-3 bg-white rounded shadow">
                        <div class="wrapper">
                            <form action="{{ route('login') }}" method="post" name="Login_Form" class="form-signin">
                                @csrf
{{--                                <input type="text" class="form-control my-2 font-weight-bold" name="usuario" placeholder="Seu usuário" required="" autofocus="" />--}}
                                <input id="email" type="email" class="form-control my-2 font-weight-bold @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="form-control my-2 font-weight-bold @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-lg btn-primary btn-block my-2 font-weight-bolder"  name="Submit" value="Login" type="Submit">Entrar</button>
                                <div class="container" style="text-align: center">
                                @if(!Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                        @auth
                                        @else
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="text-sm text-gray-700 underline">Register</a>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="es">
    
<head>
        <title>Asociación Riojana de Baby Fútbol Infantil</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/matrix-login.css')}}" />
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
            <form id="loginform" class="form-vertical" method="post" action="{{ url('/user') }}"> {{ csrf_field() }}
                 <div class="control-group normal_text"> <h3><img src="{{ asset('img/frontend_img/logo.jpg')}}" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="fas fa-user"> </i></span><input type="text" name="username" placeholder="Nombre de Usuario" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="fas fa-lock"></i></span><input type="password" name="password" placeholder="Contraseña" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><input type="submit" value="Ingresar al sistema" class="btn btn-success"/></span>
                    <span class="pull-left"><a href="{{url('/')}}" class="btn btn-info"> Página principal</a></span>
                </div>
            </form>
        </div>
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
        <script src="{{ asset('js/backend_js/jquery.min.js') }}"></script>  
        <script src="{{ asset('js/backend_js/matrix.login.js') }}"></script> 
        <script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
    </body>

</html>

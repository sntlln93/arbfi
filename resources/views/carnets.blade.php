<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
           body{
                    font-family: 'Roboto', sans-serif;
                }

            .fila{
                padding-top: 1.5cm;
                padding-left: 1.5cm;
                padding-right: 1.5cm;
                display:grid;
                grid-template-columns: 8.6cm 8.6cm;
                grid-template-rows: 5.38cm;
                grid-gap: 0.8cm;
                
            }  
            .carnet{
                background-image: url('/img/backend_img/background1.png');        
                border-style: solid;   
                display:grid;
            }
            .cabecera{
                display: grid;
                grid-template-columns: 1cm 6cm;
                padding-left: 0.3cm;
                padding-top: 0.1cm;
            }

            .titulos .titulo{
                font-size: 9px;
                font-weight: bold;
                text-transform: uppercase;
            }
            .titulos .subtitulo{
                font-size: 8px;
                font-weight: normal;
                text-transform: uppercase;
            }
            .logo img{
                width: 25px;
                height: auto;
                
            }
            .foto{
                margin-left: auto;
                margin-right: auto;
                align-content: center;
            }
            .foto img{
                padding-top:2mm;
                height: 30mm;
                width: auto;            
            }
            .foto h3{
                padding-top: 0mm;
                font-size: 15px;
                font-weight: bold;
                text-align: center;
            }
            .foto p{
                padding-top: 0mm;
                font-size: 5px;
                text-align: center;
            }
            .row{
                display: grid;
                grid-template-columns: 35mm 50mm;
            }

            .info .titulo{
                font-size: 7px;
                text-transform: uppercase;
                padding-top: 1.2mm;
            }
            .info .subtitulo{
                font-size: 9px;
                text-transform: uppercase;
                font-weight: bold;
                text-shadow: 1px 1px 1px blanchedalmond;
            }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
            <div class="fila">
                @foreach($players as $player)
                <div class="carnet">
                    <div class="row">
                        <div class="cabecera">
                            <div class="logo">
                                <img src="{{ asset('/img/frontend_img/logo-light.png') }}" alt="">
                            </div>
                            <div class="titulos">
                                <div class="titulo">Asociación Riojana de Baby Fútbol Infantil</div>
                                <div class="subtitulo">Carnet identificador de jugador</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="foto">
                            <img src="{{ getImage($player, 'players') }}" alt="">
                            <p>Número de documento</p>
                            <h3>{{ $player->dni }}</h3>
                        </div>
                        <div class="info">
                            
                            <div class="titulo">Apellidos</div>
                            <div class="subtitulo">{{ $player->last_name }}</div>
                            <div class="titulo">Nombres</div>
                            <div class="subtitulo">{{ $player->first_name }}</div>
                            <div class="titulo">Club</div>
                            <div class="subtitulo">{{ $player->team->club->name }}</div>
                            <div class="titulo">Fecha de nacimiento</div>
                            <div class="subtitulo">{{ $player->birth_date->format('d/m/Y') }}</div>
                            <div class="titulo">Fecha de emisión</div>
                            <div class="subtitulo">{{ Carbon\Carbon::now()->format('d/m/Y') }}</div>
                            <div class="titulo">Categoría</div>
                            <div class="subtitulo">{{ $player->team->category->name }}</div>
                            <div class="barcode"></div>
                        </div>
                    </div>
                </div>
                
                @endforeach
                
            </div>
</body>
</html>
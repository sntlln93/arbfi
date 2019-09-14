<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carnets</title>

    <style>
           body{
                    font-family: 'Roboto', sans-serif;
                }

            .fila{
                display:grid;
                grid-template-columns: 8.6cm 8.6cm;
                grid-template-rows: 5.38cm;
                grid-gap: 0.6cm;
                
            }  
            .carnet{
                background-image: url({{ asset('/img/backend_img/background1.png') }});        
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
                grid-template-columns: 35mm 40mm 10mm;
                position: relative;
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
            .barcode {
                margin-right: 3mm;
                margin-bottom: 3mm;
                position: absolute;
                bottom: 0;
                right: 0;
            }


    </style>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body><div style="page-break-before:always"></div>
            <div class="fila">@php($count = 0)
                @foreach($players as $player)
                    @if($count/10 == 1)
                        <div style="page-break-before:always"></div>
                    @endif
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
                                @if(isset($player->image))
                                    <img src="{{ asset('storage/'.$player->image->path) }}" alt="">
                                @else
                                    <img src="{{ asset('img/frontend_img/players/0.jpg') }}" alt="">
                                @endif
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
                            </div>
                            <div class="barcode">
                                {!! QrCode::size(80)->generate(url('players/'.$player->id.'/validate')) !!}
                            </div>
                        </div>
                    </div>
                    @php($count++)
                @endforeach     
            </div>
</body>
</html>
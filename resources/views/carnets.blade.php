<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/carnet.css">
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
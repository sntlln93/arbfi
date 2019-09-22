<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Clubs</h1>
    @foreach($clubs as $club)
        <img style="width:100px; height:100px" src="{{ asset('storage/clubs/'.$club) }}" alt="">
    @endforeach
    
    <hr>
    <h1>Players</h1>
    @foreach($players as $player)
        <img style="width:100px; height:100px" src="{{ asset('storage/players/'.$player) }}" alt="">
    @endforeach

</body>
</html>
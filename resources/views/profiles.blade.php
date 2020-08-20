<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Merkado Croqueta</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>

    <!-- <div class="middle">
        <b><a href="{{ route('login') }}" class="btn btn1">
                <center> Atención a Clientes</center>
            </a>
            <a href="{{ route('login') }}" class="btn btn2">
                <center>Sucursales</center>
            </a>
            <a href="{{ route('login') }}" class="btn btn3">
                <center>Contabilidad</center>
            </a>
            <a href="{{ route('login') }}" class="btn btn4">
                <center>Administrador</center>
            </a>
        </b>
    </div> -->
    <h1>MERKADO CROQUETA</h1>

    <div class="boxesContainer">
        <div class="cardBox">
            <div class="card">
                <div class="front">
                    <h3>Ventas en Línea</h3>
                    <span class="icon-display tamaño"></span>
                </div>
                <div class="back">
                    <h3>Registra tus Ventas</h3>
                    <p></p>
                    <a href="{{ route('login') }}">Accede al Módulo</a>
                </div>
            </div>
        </div>

        <div class="cardBox">
            <div class="card">
                <div class="front">
                    <h3>Sucursales</h3>
                    <span class="icon-home tamaño"></span>
                </div>
                <div class="back">
                    <h3>¿Eres Engargado de Sucursal?</h3>
                    <p></p>
                    <a href="{{ route('login') }}">Accede al Módulo</a>
                </div>
            </div>
        </div>

        <div class="cardBox">
            <div class="card">
                <div class="front">
                    <h3>Contabilidad</h3>
                    <span class="icon-stats-dots tamaño"></span>
                </div>
                <div class="back">
                    <h3>Personal Autorizado</h3>
                    <p></p>
                    <a href="{{ route('login') }}">Accede al Módulo</a>
                </div>
            </div>
        </div>

        <div class="cardBox">
            <div class="card">
                <div class="front">
                    <h3>Administrador</h3>
                    <span class="icon-user-tie tamaño"></span>
                </div>
                <div class="back">
                    <h3>Personal Autorizado</h3>
                    <p></p>
                    <a href="{{ route('login') }}">Accede al Módulo</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Merkado Croqueta</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        @import 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300';

        body {
            margin: 0;
            padding: 0;
            background:white;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn {
            position: relative;
            display: block;
            color: black;
            font-size: 17px;
            font-family: "nunito";
            text-decoration: none;
            margin: 30px 0;
            border: 2px solid #33FFFD;
            padding: 14px 60px;
            text-transform: uppercase;
            overflow: hidden;
            transition: 1s all ease;
        }

        .btn::before {
            background: #33FFFD;
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            transition: all 0.6s ease;
        }

        .btn1::before {
            width: 0%;
            height: 100%;
        }

        .btn1:hover::before {
            width: 100%;
        }


        .btn2::before {
            width: 100%;
            height: 0%;
        }

        .btn2:hover::before {
            height: 100%;
        }

        .btn3::before {
            width: 100%;
            height: 0%;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .btn3:hover::before {
            height: 380%;
        }

        .btn4::before {
            width: 100%;
            height: 0%;
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .btn4:hover::before {
            height: 380%;
        }
    </style>
</head>

<body>
    
 <div class="middle">
        <a href="{{ route('login') }}" class="btn btn1">Atención a Clientes</a>
        <a href="{{ route('login') }}" class="btn btn2">Sucursales</a>
        <a href="{{ route('login') }}" class="btn btn3">Contabilidad</a>
        <a href="{{ route('login') }}" class="btn btn4">Administrador</a>
    </div>

</body>

</html>
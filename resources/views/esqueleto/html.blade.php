<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Prueba técnica realizada por Asier Suárez para aplicar al puesto de trabajo en Inteman."/>
    <meta name="keywords" content="Inteman, Prueba técnica, Laravel, Livewire"/>
    <meta name="author" content="Asier Suárez"/>
    <meta name="robots" content="nofollow"/>

    <title>Prueba Inteman | Asier Suárez</title>

    @include('esqueleto.estilos')
    @include('esqueleto.js')

</head>
<body>

    <div id="general" class="container">

        <div id="titulo">
            <h1>Prueba Técnica Inteman</h1>
            <h2>Asier Suárez</h2>
        </div>

        <div id="listado" class="row">

            @yield('listado')

        </div>

        <div id="desglose" class="row">

            @yield('desglose')

        </div>

    </div>

</body>
</html>
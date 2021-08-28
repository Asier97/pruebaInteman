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

    @include('links.estilos')
    @include('links.js')
    @livewireStyles

</head>
<body>

    <!-- Componente principal -->
    <div id="general" class="container">

        <!-- Cabecera del componente principal -->
        <div id="titulo">
            <h1>Prueba Técnica Inteman</h1>
            <h2>Asier Suárez</h2>
        </div>

        <!-- Componente Livewire Inteman, el componente principal, que contiene la aplicación en sí -->
        <livewire:inteman/>
        
    </div>

    <!-- Componente Livewire Msgs, que escucha al componente principal para lanzar mensajes al usuario -->
    <livewire:msgs/>
    @livewireScripts
</body>
</html>

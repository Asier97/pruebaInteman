@extends('esqueleto.html')

{{-- Sección de la lista de tareas --}}

@section('listado')

    <div id="add" class="col-12">
        <label for="btnadd" class="info">Puedes añadir una tarea con este botón...</label>
        <button id="btnadd" type="button" class="btn btn-primary">Añadir</button>
    </div>

    <div class="data col-12">
        <label>Nombre de prueba</label>
        <label class="hint">ID: 823</label>
        <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
    </div>

    <div class="data col-12">
        &nbsp;
    </div>

    <div class="data col-12">
        &nbsp;
    </div>

    <div class="data col-12">
        &nbsp;
    </div>

    <div class="data col-12">
        &nbsp;
    </div>

    <div id="coletilla" class="col-12">
        <a class="btn btn-primary" href="#add" role="button">&nbsp;<i class="fas fa-angle-up"></i>&nbsp;</a>
    </div>
    
@endsection

{{-- Sección del desglose de tareas --}}

@section('desglose')
    
@endsection
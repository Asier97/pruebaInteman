@extends('esqueleto.html')

{{-- Sección de la lista de tareas --}}

@section('listado')

    <div id="add">
        <label for="btnadd" class="info">Puedes añadir una tarea con este botón...</label>
        <button id="btnadd" type="button" class="btn btn-primary">Añadir</button>
    </div>

    <div id="coletilla">
        <a class="btn btn-primary" href="#add" role="button">&nbsp;<i class="fas fa-angle-up"></i>&nbsp;</a>
    </div>
    
@endsection

{{-- Sección del desglose de tareas --}}

@section('desglose')
    
<div class="form-group">
    <label for="nombre">Tarea:</label>
    <input type="text" class="form-control" id="nombre" placeholder="Nombre de la tarea">
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea class="form-control" id="descripcion" aria-describedby="hint"></textarea>
    <small id="hint" class="form-text text-muted">Aquí va la descripción de la tarea.</small>
</div>

<div>
    <button id="btnguardar" type="button" class="btn btn-success">Guardar</button>
</div>

@endsection
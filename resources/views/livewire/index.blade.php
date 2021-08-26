<div class="row align-items-start">
    <!-- Sección de la lista de tareas -->
    <div class="col-12 col-lg-5">
        <div id="listado" class="contenedor-data">

            <div id="add">
                <label for="btnadd" class="info">Añadir tarea</label>
                <button id="btnadd" type="button" class="btn btn-primary" wire:click="create">Añadir</button>
            </div>

            @foreach($listaTareas as $t)
                <div class="data" wire:click="show({{ $t->id }})">
                    <label>{{ $t->nombre }}</label>
                    <label class="hint">ID: {{ $t->id }}</label>
                    <button type="button" class="btn btn-danger" wire:click="delete({{ $t->id }})"><i class="fas fa-trash"></i></button>
                </div>
            @endforeach
        
            <div id="coletilla">
                <a class="btn btn-primary" href="#add" role="button">&nbsp;<i class="fas fa-angle-up"></i>&nbsp;</a>
            </div>

        </div>
    </div>
    <!-- Sección del desglose de tareas -->
    <div class="col-12 col-lg-7">
        <div id="desglose" class="contenedor-data">

            <div class="form-group">
                <label for="nombre">Tarea:</label>
                <label id="id_tarea" class="hint">{{ $tid }}</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre de la tarea" wire:model="nombre">
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" aria-describedby="hint" wire:model="descripcion"></textarea>
                <small id="hint" class="form-text text-muted">Aquí va la descripción de la tarea.</small>
            </div>
            
            <div>
                <button id="btnadd" type="button" class="btn btn-success" wire:click="create">Añadir</button>
                <button id="btnmod" type="button" class="btn btn-primary">Modificar</button>
                <button id="btndel" type="button" class="btn btn-danger">Eliminar</button>
            </div>

        </div>
    </div>
</div>

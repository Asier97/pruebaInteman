<div class="row align-items-start">
    <!-- Sección de la lista de tareas -->
    <div class="col-12 col-lg-5">
        <div id="listado" class="contenedor-data">

            <div id="add">
                <label for="btnadd" class="info">Añadir tarea</label>
                <button id="btnadd" type="button" class="btn btn-primary" wire:click="new">Añadir</button>
            </div>

            @foreach($tareas as $key => $t)
                <div class="data" wire:click="show({{ $key }})">
                    <label>{{$t->nombre}}</label>
                    <label class="hint">ID: {{ $t->id }}</label>
                    <button type="button" class="btn btn-danger" wire:click.stop="delete({{ $key }})"><i class="fas fa-trash"></i></button>
                </div>
            @endforeach
        
            <div id="coletilla">
                <a class="btn btn-primary {{$btnup}}" href="#add" role="button">&nbsp;<i class="fas fa-angle-up"></i>&nbsp;</a>
            </div>

        </div>
    </div>
    <!-- Sección del desglose de tareas -->
    <div class="col-12 col-lg-7">
        <div id="desglose" class="contenedor-data">

            <div class="form-group">
                <label for="nombre">Tarea:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre de la tarea" wire:model="tarea.nombre">
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" aria-describedby="hint" wire:model="tarea.descripcion"></textarea>
                <small id="hint" class="form-text text-muted">Aquí va la descripción de la tarea.</small>
            </div>
            
            <div>
                <button type="button" class="btn btn-success {{$btnadd}}" wire:click="create">Añadir</button>
                <button type="button" class="btn btn-primary {{$btnact}}" wire:click="modify">Modificar</button>
                <button type="button" class="btn btn-danger {{$btnact}}" wire:click="delete">Eliminar</button>
            </div>

        </div>
    </div>
    <!-- Seccion simple con el botón del seeder -->
    <div class="col-12">
        <div>
            <button type="button" class="btn btn-secondary float-right" wire:click="rellenarPorDefecto">Poner datos por defecto</button>
        </div>
    </div>
</div>

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use Database\Seeders\TareaSeeder;

class Inteman extends Component
{
    
    // La lista de tareas en BD que se modificará dinámicamente.
    public $tareas;

    // La posición en lista de la tarea seleccionada.
    // Se guarda para mejorar la experiencia de usuario en procedimientos como modificar o borrar.
    public $pos;

    // La tarea seleccionada. También se usa para crear tareas nuevas.
    public Tarea $tarea;

    // Variables de botones. Estas variables se utilizan para mostrar o ocultar botones.

    // Botón para ir al comienzo de la lista de tareas.
    public $btnup;

    // Botón de añadir tarea.
    public $btnadd;

    // Botón de modificar o eliminar tareas.
    public $btnact;

    // Validación de campos.
    protected $rules = [
        'tarea.nombre' => 'required|string|max:255',
        'tarea.descripcion' => 'string|max:1000'
    ];

    /* ##################################### */
    /* ##  Funciones CRUD y relacionadas  ## */
    /* ##################################### */

    /**
     * Limpia el formulario para añadir una nueva tarea.
     */
    public function new() {
        // Limpia la posición y tareas guardadas en memoria.
        $this->pos = null;
        $this->tarea = new Tarea();

        // Muestra el botón de Añadir y oculta los de Modificar y Eliminar.
        $this->swapBotones(true);
    }

    /**
     * Crea una nueva tarea a partir de los datos de formulario.
     */
    public function create()
    {
        try
        {
            // Valida los campos
            $this->validate();

            // Comprueba que se haya guardado bien.
            if ($this->tarea->save())
            {
                // Se guarda tarea en memoria y en lista y se informa.
                $this->tareas->push($this->tarea);
                $this->tarea = new Tarea();
                $this->emit('msgs:mostrar',['Tarea guardada.','success']);

                // Se comprueba si hace falta mostrar el botón de ir al inicio de lista.
                $this->showBtnUp();
            }
            // En caso de error se informa al usuario.
            else $this->emit('msgs:mostrar',['Ha ocurrido un error insertando la tarea.','error']);

        }
        // Salta si falla la validación.
        catch (\Illuminate\Validation\ValidationException $e)
        {
            $msg = '';

            // Se comprueba porqué ha podido fallar la validación y se informa.
            if ($this->tarea->nombre=='') $msg = 'Por favor, ponga nombre a la tarea.';
            elseif (strlen($this->tarea->nombre)>250) $msg = 'Por favor, elija un nombre más corto.';
            elseif (strlen($this->tarea->descripcion)>990) $msg = 'Por favor, acorte la descripción.';
            else $msg = 'Ha ocurrido un error validando los campos.';

            $this->emit('msgs:mostrar',[$msg,'info']);
        }
    }

    /**
     * Muestra una tarea de la lista en el formulario. Guarda la p
     * 
     * @param   $index  Posición de la tarea en la lista
     */
    public function show($index)
    {
        // Se guarda la posición de la tarea seleccionada y la tarea en sí.
        $this->pos = $index;
        $this->tarea = $this->tareas[$index];
        
        // Se oculta el botón Añadir y se muestran Modificar y Eliminar
        $this->swapBotones(false);
    }

    /**
     * Modifica la tarea seleccionada. Función muy similar a create()
     */
    public function modify()
    {
        try
        {
            $this->validate();

            if ($this->tarea->save())
            {
                // Se actualiza la tarea de la lista también y se informa al usuario
                $this->tareas[$this->pos] = $this->tarea;
                $this->emit('msgs:mostrar',['Tarea modificada correctamente','success']);
            }
            else $this->emit('msgs:mostrar',['Ha ocurrido un error modificando la tarea.','error']);
        }
        catch (\Illuminate\Validation\ValidationException $e)
        {
            $msg = '';

            if ($this->tarea->nombre=='') $msg = 'Por favor, ponga nombre a la tarea.';
            elseif (strlen($this->tarea->nombre)>250) $msg = 'Por favor, elija un nombre más corto.';
            elseif (strlen($this->tarea->descripcion)>990) $msg = 'Por favor, acorte la descripción.';
            else $msg = 'Ha ocurrido un error validando los campos.';

            $this->emit('msgs:mostrar',[$msg,'info']);
        }
        
    }

    /**
     * Borra una tarea.
     * 
     * @param   $index  Si se borra desde lista se especifica, si se borra desde formulario no.
     */
    public function delete($index = false)
    {
        // Si existe $index se coge la tarea de la lista y se borra
        if ($index!==false)
        {
            $temp = $this->tareas[$index];
            $confirm = $temp->delete();
        }
        // Si no, se borra la que está en el formulario.
        else $confirm = $this->tarea->delete();

        if ($confirm)
        {
            // Se borra la tarea de la lista usando $index o $pos dependiendo del origen de la llamada.
            $this->tareas->forget($index !== false ? $index : $this->pos);

            // Si se borra desde la lista la tarea cargada en memoria, se limpia.
            if ($index===false || $index == $this->pos)  $this->new();

            // Si se borra una tarea de la lista anterior a la seleccionada, se disminuye la posición de la taera seleccionada.
            if ($index < $this->pos) $this->pos--;

            // Se manda mensaje informando de que ha ido bien el borrado
            $this->emit('msgs:mostrar',['Tarea eliminada correctamente','success']);
            
            // Se comprueba si hace falta ocultar el botón de subir en la lista.
            $this->showBtnUp();
        }
        // Se informa al usuario de que ha habido un error borrando la tarea.
        else $this->emit('msgs:mostrar',['Ha ocurrido un error borrando la tarea','error']);
    }

    /* ########################## */
    /* ##  Resto de funciones  ## */
    /* ########################## */

    /**
     * Comprueba si hace falta mostrar o ocultar el botón de subir en lista
     */
    public function showBtnUp()
    {
        // Si hay más de 4 tareas se muestra, de lo contrario se oculta.
        if (count($this->tareas)>4) $this->btnup = 'div-visible';
        else $this->btnup = 'div-invisible';
    }

    /**
     * Alterna entre mostrar Añadir y ocultar Modificar y Eliminar o al revés.
     * 
     * @param   $add    Si es positivo muestra Añadir. Si es negativo, Modificar y Eliminar.
     */
    private function swapBotones($add = true)
    {
        if ($add)
        {
            $this->btnadd = 'btn-visible';
            $this->btnact = 'btn-oculto';
        }
        else
        {
            $this->btnadd = 'btn-oculto';
            $this->btnact = 'btn-visible';
        }
    }

    /**
     * Reinicia la base de datos y añade tareas por defecto.
     */
    public function rellenarPorDefecto()
    {
        if (Tarea::truncate())
        {
            try
            {
                // Se instancia el seeder y se lanza.
                $seeder = new TareaSeeder();
                $seeder->run();

                // Si no se captura ningún error se informa
                $this->emit('msgs:mostrar',['Tareas por defecto insertadas.','success']);
            }
            catch (\Illuminate\Database\QueryException $e) {
                $this->emit('msgs:mostrar',['No se han podido insertar los datos por defecto.','error']);
            }

            // Se hayan insertado o no las tareas la BD ha sido modificada, así que actualizamos la lista
            $this->rellenarTareas();
        }
        else $this->emit('msgs:mostrar',['No se han podido borrar los datos.','error']);
    }

    /**
     * Coge todas las tareas de la base de datos y llena la lista
     */
    public function rellenarTareas()
    {
        $this->tareas = Tarea::get()->keyBy('id');

        // Comprueba si hace falta mostrar o ocultar el botón de subir la lista.
        $this->showBtnUp();
    }

    /* ########################## */
    /* ##  Funciones de Livewire  ## */
    /* ########################## */

    public function mount()
    {
        // Ponemos las clases a los botones del formulario para mostrar sólo Añadir
        $this->btnadd = 'btn-visible';
        $this->btnact = 'btn-oculto';

        // Rellenamos la lista con las tareas que ya existen e iniciamos $tarea
        $this->rellenarTareas();
        $this->tarea = new Tarea();

    }

    public function render()
    {
        return view('livewire.inteman');
    }
}

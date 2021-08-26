<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;

class Index extends Component
{

    // Atributos de tareas
    public $tid;
    public $nombre;
    public $descripcion;

    // Listado tareas
    public $listaTareas = array();

    public function create() {
        $tarea = new Tarea;

        $tarea->nombre = $this->nombre;
        $tarea->descripcion = $this->descripcion;

        if ($tarea->save()) {
            $this->tid = 'ID: '.$tarea->id;
        }

    }

    public function show($id) {
        /* Just to try if it works */
        $this->descripcion = "Show $id";
    }

    public function delete() {
        /* Just to try if it works */
        $this->descripcion = "Delete $id";
    }

    private function rellenarTareas() {
        $tareas = Tarea::get();

        foreach($tareas as $tarea) {
            $this->listaTareas[] = $tarea;
        }
    }

    public function mount()
    {
        // Rellenamos la lista con las tareas que ya existen
        $this->rellenarTareas();
    }

    public function render()
    {
        return view('livewire.index');
    }
}

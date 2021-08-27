<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use Database\Seeders\TareaSeeder;

class Index extends Component
{

    public Tarea $tarea;
    public $tareas;
    public $pos;

    public $btnup;
    public $btnadd;
    public $btnact;
    //truncate();

    protected $rules = [
        'tarea.nombre' => 'required|string|max:255',
        'tarea.descripcion' => 'required|string|max:1000'
    ];

    public function new() {
        $this->pos = null;
        $this->tarea = new Tarea();
        $this->swapBotones(true);
    }

    public function create() {
        if ($this->tarea->save()) {
            $this->tareas->push($this->tarea);
            $this->tarea = new Tarea();
            $this->showBtnUp();
        }
    }

    public function show($index) {
        $this->pos = $index;
        $this->swapBotones(false);
        $this->tarea = $this->tareas[$index];
    }

    public function modify() {
        if ($this->tarea->save())
            $this->tareas[$this->pos] = $this->tarea;
    }

    public function delete($index = false) {
        if ($index!==false) {
            $temp = $this->tareas[$index];
            $confirm = $temp->delete();
        } else {
            $confirm = $this->tarea->delete();
        }

        if ($confirm) {
            $this->tareas->forget($index !== false ? $index : $this->pos);

            if ($index===false || $index == $this->pos) {
                $this->new();
            }

            if ($index < $this->pos) $this->pos--;
            
            $this->showBtnUp();
        }
    }

    public function rellenarPorDefecto() {
        if (Tarea::truncate()) {
            $seeder = new TareaSeeder();
            $seeder->run();
            $this->rellenarTareas();
        }
    }

    private function showBtnUp() {
        if (count($this->tareas)>4) $this->btnup = 'btn-visible';
        else $this->btnup = 'btn-oculto';
    }

    private function swapBotones($add = true) {
        if ($add) {
            $this->btnadd = 'btn-visible';
            $this->btnact = 'btn-oculto';
        } else {
            $this->btnadd = 'btn-oculto';
            $this->btnact = 'btn-visible';
        }
    }

    private function rellenarTareas() {
        $this->tareas = Tarea::get()->keyBy('id');
        $this->showBtnUp();
    }

    public function mount()
    {
        $this->btnadd = 'btn-visible';
        $this->btnact = 'btn-oculto';

        // Rellenamos la lista con las tareas que ya existen
        $this->tarea = new Tarea();
        $this->rellenarTareas();

        //dd(count($this->tareas));
    }

    public function render()
    {
        return view('livewire.index');
    }
}

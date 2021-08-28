<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Msgs extends Component
{

    public $msg;
    public $color;
    public $colores;

    // Estaremos escuchando al componente principal para mostrar mensajes
    protected $listeners = ['msgs:mostrar' => 'mostrar'];

    /**
     * Cuando se detecte un mensaje se mostrará al usuario
     * 
     * @param   $params     [0] => El mensaje a mostrar, [1] => El color de la notificación
     */
    public function mostrar($params = ['','info'])
    {
        // Actualizamos el div del mensaje con el mensaje y el color recibidos. Cogemos el hex del calor de $colores.
        $this->msg = $params[0];
        $this->color = $this->colores[$params[1]];

        // Lanzamos un mensaje a la vista para que muestre y oculte el mensaje
        $this->emit('msgs:fades');
    }

    public function mount()
    {
        // Instanciamos los colores del mensaje junto con su código
        $this->colores = [
            'info' => '#0d6efd',
            'success' => '#198754',
            'error' => '#dc3545'
        ];
        // Ponemos por defecto el color azul de información
        $this->color = $this->colores['info'];
    }

    public function render()
    {
        return view('livewire.msgs');
    }
}

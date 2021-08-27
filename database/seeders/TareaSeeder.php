<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array("Acabar la prueba técnica", "Si estás viendo esto y no te llamas Asier Suárez, es posible que la haya acabado ya."),
            array("Llamada vía Discord con los amigos", "Después de la paliza que me estoy dando a trabajar últimamente apetece sentarse a jugar a algo con los amigos."),
            array("Barbacoa en casa de Sara", "Personalmente no me gustan las barbacoas, pero sí ver a mis amigos, que cada día está más dificil.\n\nEspero que Sara no nos de plantón este finde."),
            array("Ver el partido del PSG", "No me puedo perder el debut de Messi en otro equipo, ¡y menos verle jugar con Ramos!"),
            array("Hacer la maleta", "Las vacaciones en Cataluña del 1 al 5 me van a venir bien, desde luego. A ver que tal está todo cuando vuelva.")
        );

        foreach ($data as $v) {
            Tarea::insert([
                'nombre' => $v[0],
                'descripcion' => $v[1]
            ]);
        }
    }
}

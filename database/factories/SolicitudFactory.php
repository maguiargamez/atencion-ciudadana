<?php

namespace Database\Factories;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class SolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitud::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;
        $id_status= \App\Models\Catalogos\Status::inRandomOrder()->value('id');
        $id_tipo_solicitud= \App\Models\Catalogos\TipoSolicitud::inRandomOrder()->value('id');
        $id_prioridad= \App\Models\Catalogos\Prioridad::inRandomOrder()->value('id');
        $id_canal_acceso= \App\Models\Catalogos\CanalAcceso::inRandomOrder()->value('id');
        $id_tipo_servicio= \App\Models\Catalogos\TipoServicio::inRandomOrder()->value('id');
        //$id_colonia= \App\Models\Catalogos\Colonia::inRandomOrder()->value('id');

        $folio= null;
        if($id_status!=1 and $id_status!=3){
            $folio= 'F'.str_pad(($order++), 4, "0", STR_PAD_LEFT);
        }

        $codigo_rastreo= Str::random(8);
        $latitud= '';
        $longitud= '';
        return [
            'id_status' => $id_status,
            'id_tipo_solicitud'=> $id_tipo_solicitud,
            'id_prioridad'=> $id_prioridad,
            'id_canal_acceso'=> $id_canal_acceso,
            'folio'=> $folio,
            'nombre' => $this->faker->name,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'id_tipo_servicio'=> $id_tipo_servicio,
            'colonia'=> $this->faker->address,
            'direccion' => $this->faker->address,
            'calle_entre_1' => $this->faker->optional()->address,
            'calle_entre_2' => $this->faker->optional()->address,
            'codigo_postal' => $this->faker->randomNumber,
            'latitud'=> $this->faker->randomFloat(6,16.773548,16.733870),
            'longitud'=> $this->faker->randomFloat(6,-93.182607,-93.079041),
            'descripcion_reporte'=> $this->faker->sentence(20),
            'codigo_rastreo'=> $codigo_rastreo,
        ];
    }
}

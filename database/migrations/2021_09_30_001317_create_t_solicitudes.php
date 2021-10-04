<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_status')->length(11)->index();
            $table->unsignedInteger('id_tipo_solicitud')->length(11)->index();
            $table->unsignedInteger('id_prioridad')->length(11)->index();
            $table->unsignedInteger('id_canal_acceso')->length(11)->index();
            $table->string('folio')->length(100)->nullable();
            $table->string('nombre')->length(255);
            $table->string('apellido1')->length(255);
            $table->string('apellido2')->length(255);
            $table->string('telefono')->length(255);
            $table->string('email')->length(255);
            $table->unsignedInteger('id_tipo_servicio')->length(11)->index();
            $table->unsignedInteger('id_colonia')->length(11)->index();
            $table->string('direccion')->length(255);
            $table->string('calle_entre_1')->length(255);
            $table->string('calle_entre_2')->length(255);
            $table->string('codigo_postal')->length(255);
            $table->double('latitud', 10, 2)->nullable();
            $table->double('longitud', 10, 2)->nullable();
            $table->double('descripcion_reporte');
            $table->string('codigo_rastreo')->length(100);
            $table->boolean('activo')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            //$table->timestamps(); //Solo con SQLite
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_solicitudes');
    }
}

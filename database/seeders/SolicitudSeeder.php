<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Solicitud::factory(150)->create();
    }
}

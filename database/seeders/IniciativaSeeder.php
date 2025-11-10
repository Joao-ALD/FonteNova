<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Iniciativa;

class IniciativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = Estado::all();

        foreach ($estados as $estado) {
            Iniciativa::factory()->count(3)->create(['estado_id' => $estado->id]);
        }
    }
}

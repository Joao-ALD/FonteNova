<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeederReal extends Seeder
{
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            IniciativaRealSeeder::class,
        ]);
    }
}
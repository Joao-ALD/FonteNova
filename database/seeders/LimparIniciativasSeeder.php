<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Iniciativa;

class LimparIniciativasSeeder extends Seeder
{
    public function run()
    {
        // Limpa todas as iniciativas existentes
        Iniciativa::truncate();
        
        $this->command->info('Tabela de iniciativas limpa com sucesso!');
        $this->command->info('Agora execute: php artisan db:seed --class=IniciativaRealSeeder');
    }
}
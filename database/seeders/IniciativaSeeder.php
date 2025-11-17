<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Iniciativa;

/**
 * SEEDER PARA USO DA EQUIPE
 * 
 * Este seeder gera iniciativas de exemplo usando factories.
 * Use este seeder quando quiser adicionar dados de teste.
 * 
 * Para usar: php artisan db:seed --class=IniciativaSeeder
 */
class IniciativaSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Gerando iniciativas de exemplo com factories...');
        
        $estados = Estado::all();

        foreach ($estados as $estado) {
            Iniciativa::factory()->count(2)->create(['estado_id' => $estado->id]);
        }
        
        $this->command->info('Iniciativas de exemplo criadas com sucesso!');
    }
}

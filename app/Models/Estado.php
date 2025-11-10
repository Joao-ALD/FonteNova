<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'sigla',
        'nome',
        'regiao',
        'dados_geograficos',
    ];

    public function iniciativas()
    {
        return $this->hasMany(Iniciativa::class);
    }

    public function scopePorRegiao($query, $regiao)
    {
        return $query->where('regiao', $regiao);
    }
}

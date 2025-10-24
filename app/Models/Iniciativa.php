<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model for initiatives.
 *
 * Represents local initiatives related to water conservation and management.
 * These are displayed on the interactive map on the home page.
 */
class Iniciativa extends Model
{
    // use HasFactory;
    protected $fillable = [
        'estado_sigla',
        'titulo',
        'descricao',
    ];
}

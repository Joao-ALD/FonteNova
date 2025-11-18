<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ebook extends Model
{
    protected $fillable = ['title', 'slug', 'cover_path', 'short_description'];

    // Relacionamento: Um Ebook tem muitas páginas
    public function pages(): HasMany
    {
        // Ordena sempre pelo número da página automaticamente
        return $this->hasMany(EbookPage::class)->orderBy('page_number');
    }
}

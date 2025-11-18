<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EbookPage extends Model
{
    protected $fillable = ['ebook_id', 'page_number', 'content'];

    // Relacionamento: Uma página pertence a um Ebook
    public function ebook(): BelongsTo
    {
        return $this->belongsTo(Ebook::class);
    }
}

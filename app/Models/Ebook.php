<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Ebook.php
class Ebook extends Model
{
    protected $fillable = ['title','slug','summary','is_paid','free_preview_pages'];

    public function pages()
    {
        return $this->hasMany(EbookPage::class)->orderBy('page_number');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/EbookPage.php
class EbookPage extends Model
{
    protected $fillable = ['ebook_id','page_number','content'];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}

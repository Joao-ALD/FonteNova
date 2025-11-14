<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookProgress extends Model
{
    protected $table = 'ebook_progress';
    protected $fillable = ['user_id','ebook_id','pages_read','purchased'];

    public function user() { return $this->belongsTo(User::class); }
    public function ebook() { return $this->belongsTo(Ebook::class); }
}


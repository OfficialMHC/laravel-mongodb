<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;


    public function author() 
    {
        return $this->belongsTo(Author::class);
    }
}

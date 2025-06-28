<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'isbn',
        'publication_year',
        'genre',
        'available_copies',
    ];

// Relationship: A Book belongs to an Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}


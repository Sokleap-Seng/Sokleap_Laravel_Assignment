<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bio',
        'nationality',
    ];

    // Relationship: One Author has many Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

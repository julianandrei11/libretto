<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Many-to-Many Relationship to Book
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}

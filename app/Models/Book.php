<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    // Relationship to Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class)->using(BookGenre::class);
    }
    

    // One-to-Many Relationship to Review (if used in your system)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

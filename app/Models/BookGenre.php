<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookGenre extends Pivot
{
    protected $table = 'book_genre';

    public $timestamps = false; // Only if your pivot table has no timestamps
}

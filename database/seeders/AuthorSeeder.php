<?php


// database/seeders/AuthorSeeder.php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Create 10 authors using the AuthorFactory
        \App\Models\Author::factory(10)->create();
    }
}

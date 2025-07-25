<?php

// database/migrations/2024_06_10_000001_create_books_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBooksTable extends Migration
{
 public function up()
 {
 Schema::create('books', function (Blueprint $table) {
 $table->id();
 $table->string('title');
 $table->foreignId('author_id')->constrained()->onDelete('cascade');
 $table->timestamps();
 });
 }
 public function down()
 {
 Schema::dropIfExists('books');
 }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'copies_available'];
}
{
{
    Schema::create('books', function (Blueprint $table) {
        $table->id(); // Auto-incrementing primary key
        $table->string('title'); // Book title
        $table->string('author'); // Author name
        $table->integer('copies_available')->default(1); // Number of copies available
        $table->timestamps(); // Created_at and updated_at timestamps
    });
}

}

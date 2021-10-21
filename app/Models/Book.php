<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    // $book->createdBy->name;
    public function createdBy(){
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'id', 'updated_by');
    }
}
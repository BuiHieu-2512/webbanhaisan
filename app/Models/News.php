<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    // Cho phép mass assignment
    protected $fillable = [
        'title',
        'content',
        'image',
        'is_published',
    ];
}

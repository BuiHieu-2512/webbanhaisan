<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Các cột có thể gán giá trị.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'img',
        'description',
    ];

    /**
     * Quan hệ với Product (một Category có nhiều Products).
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

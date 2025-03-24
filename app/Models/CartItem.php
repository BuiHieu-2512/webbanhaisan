<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /**
     * Các cột có thể gán giá trị.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    /**
     * Quan hệ với Cart (một CartItem thuộc về một Cart).
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Quan hệ với Product (một CartItem thuộc về một Product).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Các cột có thể gán giá trị.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_percentage',
        'discount_start_date', 
        'discount_end_date',
        'image_url',
        'certification_image_url',
        'stock',
        'category_id',
        'weight_id',
    ];

    /**
     * Quan hệ với Category (một Product thuộc về một Category).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Quan hệ với OrderDetails (một Product có thể xuất hiện trong nhiều OrderDetails).
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Quan hệ với CartItems (một Product có thể xuất hiện trong nhiều CartItems).
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
// Tính giá sau khi giảm
public function getDiscountedPriceAttribute()
{
    if ($this->discount_percentage && now()->between($this->discount_start_date, $this->discount_end_date)) {
        return $this->price * (1 - $this->discount_percentage / 100);
    }
    return $this->price;
}

public function weight()
    {
        return $this->belongsTo(Weight::class, 'weight_id');
    }

}

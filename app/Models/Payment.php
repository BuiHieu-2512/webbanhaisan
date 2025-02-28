<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * Các cột có thể gán giá trị.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_date',
    ];

    /**
     * Quan hệ với Order (một Payment thuộc về một Order).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

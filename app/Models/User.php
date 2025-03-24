<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Các cột có thể gán giá trị thông qua model.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'address',
        'is_locked'
    ];

    /**
     * Các cột ẩn khi trả về dữ liệu JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các mối quan hệ với các bảng khác.
     */

    // Quan hệ với bảng Orders (1 User có nhiều Orders)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Quan hệ với bảng Cart (1 User có 1 Cart)
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function isAdmin() { return $this->role === 'admin'; } public function isUser() { return $this->role === 'user'; }
}

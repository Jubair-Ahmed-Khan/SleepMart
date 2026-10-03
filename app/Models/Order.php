<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'phone',
        'email',
        'division',
        'district',
        'upazila',
        'address',
        'delivery_note',
        'subtotal',
        'shipping_charge',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_charge' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'order_code',
    'customer_name',
    'customer_wa',
    'note',
    'total',
    'payment_type',
    'payment_method',           
    'payment_proof',            
    'payment_uploaded_at',      
    'amount_paid',
    'remaining',
    'status',
];

protected $casts = [
    'payment_uploaded_at' => 'datetime',
];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateCode(): string
    {
        $last = self::orderByDesc('id')->first();
        $next = $last ? ((int) substr($last->order_code, 4)) + 1 : 1;
        return 'KRY-' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_number',
        'customer_id',
        'product_id',
        'quantity',
        'total_price',
        'status', // new, completed, cancelled
        'created_at',
        'updated_at',
    ];

    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the product that belongs to the order.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
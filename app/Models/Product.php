<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'price',
        'stock',
        'is_active',
        'created_at',
        'updated_at',
    ];
    
    public function addStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    public function reduceStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            $this->save();
        } else {
            throw new \Exception('Insufficient stock to reduce');
        }
    }
}
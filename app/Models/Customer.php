<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
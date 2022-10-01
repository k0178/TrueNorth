<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    public $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'user_id',
        'prod_id',
        'price',
    ];
    
    public $timeStamps = true;
}

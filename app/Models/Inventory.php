<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    //table name
    protected $table = 'inventories';

    //Primary Key
    public $primaryKey = 'id';
    
    //timestamp
    public $timeStamps = true;
}

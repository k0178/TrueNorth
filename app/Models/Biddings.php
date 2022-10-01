<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biddings extends Model
{
    use HasFactory;

     //table name
     protected $table = 'bidtransactions';

     //Primary Key
     public $primaryKey = 'id';
     
     //timestamp
     public $timeStamps = true;
}

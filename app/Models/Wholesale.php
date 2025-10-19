<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wholesale extends Model
{
    protected $table = "wholesale";
    
    protected $fillable = ['id', 'product_id', 'quantity_f1', 'discount_f1', 'quantity_f2', 'discount_f2', 'quantity_f3', 'discount_f3', 'quantity_f4', 'discount_f4'];
}
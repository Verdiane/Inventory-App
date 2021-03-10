<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\OrderController;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['item_image', 'item_name', 'description', 'quantity', 'price'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'category', 'supplier', 'value', 'branch', 
        'observation', 'current_account', 'payment_method'
    ];
}

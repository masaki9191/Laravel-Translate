<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketprice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'during',
        'fee',
        'count',
        'type',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'ticketprice_id',
    ];
}

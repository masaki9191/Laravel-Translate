<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'amount',
        'ticketprice_id',
    ];

    public function ticketprice()
    {
        return $this->belongsTo(Ticketprice::class, 'ticketprice_id','id');
    }
}

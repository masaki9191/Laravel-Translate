<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'worker_id',
        'order_id',
        'type',
        'business_start_time',
        'business_hours',
        'sum_time',
        'service_type'
    ];

    public function order()
    {
        return $this->belongsTo(User::class, 'order_id','id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id','id');
    }
    public function workercontacted ()
    {
        $status = count(Message::where(['job_id' => $this->id])->where(['from_id' => $this->order->id])->get());
        if($status > 0)
            return 1;
        else
            return 0;
    }
    public function clientcontacted ()
    {

        $status = count(Message::where(['job_id' => $this->id])->where(['from_id' => $this->worker->id])->get());
        if($status > 0)
            return 1;
        else
            return 0;
    }
}

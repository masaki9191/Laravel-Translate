<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Translate extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'language',
        'category',
        'delivery_date',
        'price',
        'count',
        'translator_id',
        'order_id',
        'status',
        'translate_file',
        'translate_change_file',
        'delivery_text'
    ];

    public function order()
    {
        return $this->belongsTo(User::class, 'order_id','id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'translator_id','id');
    }
    public function translatorcontacted ()
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

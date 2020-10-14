<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventWeekday extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'eventdate', 'dayofweek', 'dayofweeknum'];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}

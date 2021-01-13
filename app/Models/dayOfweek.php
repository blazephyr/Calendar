<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dayOfweek extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Event()
    {
        return $this->belongsTo(Event::class);
    }
}

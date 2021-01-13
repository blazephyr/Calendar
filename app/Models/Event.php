<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded=[];
    //    protected $dates = [
    //     'dateFrom',
    //     'dateTo',
    // ];
    public function dayOfWeek()
    {
        return $this->hasMany(dayOfweek::class);
    }
}

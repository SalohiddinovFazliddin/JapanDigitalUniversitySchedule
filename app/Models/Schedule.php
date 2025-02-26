<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = [
     'subject_id',
     'user_id',
     'group_id',
     'room_id',
     'pair',
     'week_day',
     'date',


    ];
}

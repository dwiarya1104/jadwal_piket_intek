<?php

namespace App;
use ScheduleController;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable = [
        'task_title',
        'task_description',
        'user_id',
        'tanggal',
        'status',
        'upload_bukti'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
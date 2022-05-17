<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $table = 'user_activity_log';
    protected $fillable = [
        'name_user',
        'name_admin',
        'pp',
        'status_activity',
        'status_jadwal',
        'tanggal',
        'created_at',
    ];
}
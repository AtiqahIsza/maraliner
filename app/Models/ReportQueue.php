<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportQueue extends Model
{
    use HasFactory;

    protected $table = 'report_queue';

    function User()
    {
        return $this->belongsTo(User::class, 'user_user_id', 'user_id');
    }
}
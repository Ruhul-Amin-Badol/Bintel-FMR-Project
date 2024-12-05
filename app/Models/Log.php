<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Log extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sms_log';

    public function sender_name()
    {
        return $this->belongsTo(Sender::class, 'sender_id', 'sender_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchCourse extends Model
{
    use HasFactory;
    protected $table = 'batch_course';
    protected $fillable = [
        'batch_id',
        'course',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchCategory extends Model
{
    use HasFactory;
    protected $table = 'batch_category';
    protected $fillable = [
        'batch_id',
        'category',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'expenses_date',
        'employee_id',
        'type',
        'total_cost',
        'comments',
      
    ];

    public function employee()
    {
        return $this->belongsTo(Officer::class, 'employee_id', 'employee_id')->withDefault(function () {
            return null;
        });
    }
}

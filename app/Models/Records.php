<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Records extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'collection_date',
        'employee_id',
        'location',
        'cost',
        'institute',
        'others_institute',
        'library',
        'teacher',
        'student',
        'books_count',
        'quiz',
        'comments',
    ];

    public function employee()
    {
        return $this->belongsTo(Officer::class, 'employee_id', 'employee_id')->withDefault(function () {
            return null;
        });
    }


//     public function scopeByOfficerName($query, $name)
// {
//     return $query->whereHas('employee', function ($q) use ($name) {
//         $q->where('name', 'LIKE', '%' . $name . '%');
//     });
// }




}

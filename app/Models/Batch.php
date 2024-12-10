<?php

namespace App\Models;

use App\Models\BatchCategory;
use App\Models\BatchCourse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batch';
    protected $fillable = [
        'employee_id',
        'date',
        'batch_name',
        'owner_name',
        'contact_number',
        'detail_address',
        'area_name',
        'division',
        'upazilla',
        'zilla',
        'union_name',
        'teachers_quantity',
        'student_quantity',
        'school_name',
        'student_quantity',
        'teachers_comment',
        'senior_sales_executive_comments',
        'created_by',
        'updated_by',

    ];
    
    // Add relationships for courses and categories
    public function categories()
    {
        return $this->hasMany(BatchCategory::class, 'batch_id');
    }

    public function courses()
    {
        return $this->hasMany(BatchCourse::class, 'batch_id');
    }

    // Add relationships for location
    public function divisionData()
    {
        return $this->belongsTo(Division::class, 'division', 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'zilla', 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazilla', 'upazila_id');
    }
    public function officer()
    {
        return $this->belongsTo(Officer::class, 'employee_id', 'employee_id');
    }

}

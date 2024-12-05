<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    protected $table = 'institution';
    protected $fillable = [
        'employee_id',
        'date',
        'institution_name',
        'designation',
        'teachers_name',
        'contact_number',
        'detail_address',
        'area_name',
        'division',
        'upazilla',
        'zilla',
        'union_name',
        'teachers_quantity',
        'student_quantity',
        'teachers_comment',
        'senior_sales_executive_comments',
        'created_by',
        'updated_by'
        
    ];

    public function divisionData()
    {
        return $this->belongsTo(Division::class,'division','division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'zilla','district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class,'upazilla','upazila_id');
    }
     // Relationship with InstitutionCategory
     public function categories()
     {
         return $this->hasMany(InstitutionCategory::class, 'institution_id', 'id');
     }
 
     // Relationship with InstitutionClass
     public function classes()
     {
         return $this->hasMany(InstitutionClass::class, 'institution_id', 'id');
     }
 
     // Relationship with InstitutionGroup
     public function groups()
     {
         return $this->hasMany(InstitutionGroup::class, 'institution_id', 'id');
     }
}

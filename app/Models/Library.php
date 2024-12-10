<?php

namespace App\Models;

use App\Models\Division;
use App\Models\LibraryCategory;
use App\Models\LibraryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'library';
    protected $fillable = [
        'employee_id',
        'date',
        'library_Name',
        'owner_name',
        'contact_number',
        'detail_address',
        'area_name',
        'division',
        'upazilla',
        'zilla',
        'union_name',
        'librarian_comments',
        'senior_sales_executive_comments',
        'created_by',
        'updated_by',

    ];

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

    public function categories()
    {
        return $this->hasMany(LibraryCategory::class, 'library_id');
    }

    public function types()
    {
        return $this->hasMany(LibraryType::class, 'library_id');
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'employee_id', 'employee_id');
    }
}

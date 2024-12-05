<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'visiting_report';
    protected $fillable = [
        'library_type',
        'employee_id',
        'library_name',
        'owner_name',
        'contact_number',
        'date',
        'area',
        'division_id',
        'district_id',
        'upazila_id',
        'available_books',
        'books_collected_from',
        'sales_executive_comments',
        'what_category_comments',
        'agent_library_comments',
        'any_problem_comments',
        'new_books_on_time_comments',
        'mr_contact_comments',
        'improve_our_service_comments'
    ];


    public function division()
    {
        return $this->belongsTo(Division::class, 'id','division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id','district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'id','upazila_id');
    }
}

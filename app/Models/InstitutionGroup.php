<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionGroup extends Model
{
    use HasFactory;
    protected $table = 'institution_group';
    protected $fillable = [
        'institution_id',
        'group_name',
    ];
    // Inverse relationship with Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }
}

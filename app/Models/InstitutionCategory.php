<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionCategory extends Model
{
    use HasFactory;
    protected $table = 'institution_category';
    protected $fillable = [
        'institution_id',
        'category',
    ];
    // Inverse relationship with Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }
}

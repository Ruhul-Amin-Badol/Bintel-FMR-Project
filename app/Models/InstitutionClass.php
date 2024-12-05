<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionClass extends Model
{
    use HasFactory;
    protected $table = 'institution_class';
    protected $fillable = [
        'institution_id',
        'class',
    ];
    // Inverse relationship with Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }
}

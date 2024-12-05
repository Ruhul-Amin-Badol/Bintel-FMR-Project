<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;

class LibraryType extends Model
{
    use HasFactory;
    protected $table = 'library_type';
    protected $fillable = [
        'library_id',
        'library_type',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}

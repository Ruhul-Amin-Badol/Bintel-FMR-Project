<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;


class LibraryCategory extends Model
{
    use HasFactory;
    protected $table = 'library_categories';
    protected $fillable = [
        'library_id',
        'category',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }


}

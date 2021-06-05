<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'notebook_id',
        'pid',
        'source_id',
        'title',
        'sort',
        'status',
    ];
}

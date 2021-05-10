<?php

namespace App\Models;

use App\Cast\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'desc',
        'config',
        'version',
        'cover',
        'status',
        'type',
        'view_count',
        'collect_count',
        'fork_count',
    ];

    protected $casts=['config'=>Json::class];
}

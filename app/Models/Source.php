<?php

namespace App\Models;

use App\Cast\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'content',
        'size',
        'user_id'
    ];

    protected $casts = [
        'content' => Json::class
    ];


}

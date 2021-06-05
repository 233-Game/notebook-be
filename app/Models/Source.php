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
        'user_id',
        'note_catalog_id'
    ];

    protected $casts = [
        'content' => Json::class
    ];


    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'source_tags');
    }

    public function notebook(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(NoteBook::class,NoteCatalog::class,'id','id','note_catalog_id','notebook_id');
    }

    public function catalog(){

    }


}

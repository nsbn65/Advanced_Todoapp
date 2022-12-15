<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'content', 
        'created_at',
        'updated_at',
    ];
    public function getTags()
    {
        $tags = Tag::pluck('tag_name', 'id');
    }

    public function Todo()
    {
        return $this->hasMany(Todo::class);
    }
}

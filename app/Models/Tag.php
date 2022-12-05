<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 
        'created_at'
    ];
    public function author()
    {
    return $this->belongsTo('App\Models\Todo');
    }
    use HasFactory;
}

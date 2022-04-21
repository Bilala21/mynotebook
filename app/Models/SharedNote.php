<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedNote extends Model
{
    use HasFactory;
    public function note(){
        return $this->belongsTo(Note::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

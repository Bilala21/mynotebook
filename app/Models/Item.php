<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=['status'];

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function note(){
        return $this->belongsTo(Note::class);
    }
    public function assignment(){
        return $this->hasOne(AssignItem::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

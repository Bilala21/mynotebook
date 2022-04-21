<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','user_id'];

    public function category(){
        return $this->hasMany(Category::class);
    }
    public function item(){
        return $this->hasMany(Item::class);
    }
    public function shardNote(){
        return $this->hasMany(SharedNote::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pinNote(){
        return $this->hasMany(PinNote::class);
    }

    public function comments(){
        return $this->hasMany(NoteComment::class);
    }
}

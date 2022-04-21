<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function shareNote(){
        return $this->belongsTo(SharedNote::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reply(){
        return $this->belongsTo(Reply::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
}

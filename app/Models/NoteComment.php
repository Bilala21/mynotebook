<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    use HasFactory;
    public function note(){
        return $this->belongsTo(Note::class);
    }
}

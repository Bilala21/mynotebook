<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharedNoteController extends Controller
{
    public function shareNotes(){
        return "shareNotes";
    }
    public function pinNote(){
        return "pinNote";
    }
    public function addNote(){
        return "addNote";
    }
    public function updateNote($id){
        return "updateNote";
    }
    public function trashNote($id){
        return "trashNote";
    }
}

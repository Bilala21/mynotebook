<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comments(){
        return "comments";
    }
    public function commentReply(){
        return "commentReply";
    }
}

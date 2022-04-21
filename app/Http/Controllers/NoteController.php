<?php

namespace App\Http\Controllers;

use App\Models\AssignItem;
use App\Models\Comment;
use App\Models\Item;
use App\Models\ItemComment;
use App\Models\Note;
use App\Models\NoteComment;
use App\Models\PinNote;
use App\Models\SharedNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class NoteController extends Controller
{
    public function myNote()
    {

        $mynotes = Note::where("user_id", auth()->user()->id)->with(["item",'comments'])->get();
        if (!$mynotes->isEmpty()) {
            return response()->json(["status" => 200, "data" => $mynotes]);
        } else {
            return response()->json(["status" => 404, "data" => "No Recodrd found for this user"]);
        }
    }

    public function addNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $addNote = new Note();
        $addNote->title = $request->title;
        $addNote->user_id = auth('sanctum')->user()->id;
        if ($addNote->save()) {
            return response()->json(["status" => 200, "message" => "Your note is added", "note_id" => $addNote->id]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not added, Please retry..."]);
        }
    }

    public function updateNote(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if (Note::where('id', $request->id)->update(array('title' => $request->title))) {
            return response()->json(["status" => 200, "message" => "Your note is updated"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not updated, Please retry..."]);
        }
    }

    public function trashNote($id)
    {
        if (Note::where('id', $id)->delete()) {
            return response()->json(["status" => 200, "message" => "Your note is deleted"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not deleted, Please retry..."]);
        }
    }

    public function addItem(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            // 'note_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $addItem = new Item();
        $addItem->title = $request->title;
        $addItem->note_id = $request->note_id;
        if ($addItem->save()) {
            return response()->json(["status" => 200, "message" => "Your item is added"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your item is not added, Please retry..."]);
        }
    }

    public function updateItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if (Item::where('id', $request->id)->update(array('title' => $request->title))) {
            return response()->json(["status" => 200, "message" => "Your item is updated"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your item is not updated, Please retry..."]);
        }
    }
    public function trashItem($id)
    {
        if (Item::where('id', $id)->delete()) {
            return response()->json(["status" => 200, "message" => "Your note is deleted"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not deleted, Please retry..."]);
        }
    }

    public function assignItem(Request $request)
    {
        $assignItem = new AssignItem();
        $assignItem->item_id = $request->item_id;
        $assignItem->receiver_id = $request->receiver_id;
        if ($assignItem->save()) {
            return response()->json(["status" => 200, "message" => "Your item is assigned"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your item is not assigned, Please retry..."]);
        }
    }

    public function showAssignItem()
{
        $showAssignItem = AssignItem::where("receiver_id", auth()->user()->id)->with("item")->get();
        dd($showAssignItem->toArray());
    }

    public function allItems($id){
        $allItems = Item::where("note_id", $id)->get();

        if(!$allItems->isEmpty()){
            return response()->json(["status" => 200, "data" => $allItems]);
        }
        else{
            return response()->json(["status" => 404, "data" => "Not record found"]);
        }
    }

    public function pinItem()
    {
        return "pinItem";
    }

    public function shareNotes(Request $request)
    {
        $shareNote = new SharedNote();
        $shareNote->note_id = auth()->user()->id;
        $shareNote->receiver_id = $request->receiver_id;
        if ($shareNote->save()) {
            return response()->json(["status" => 200, "message" => "Your note is shared"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not shared, Please retry..."]);
        }
    }

    public function showSharedNote()
    {
        $showAssignItem = SharedNote::where("receiver_id", auth()->user()->id)->with("note")->get();
        dd($showAssignItem->toArray());
    }

    public function pinNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'note_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $addItem = new PinNote();
        $addItem->user_id = $request->user_id;
        $addItem->note_id = $request->note_id;
        if ($addItem->save()) {
            return response()->json(["status" => 200, "message" => "Your note is pined"]);
        } else {
            return response()->json(["status" => 400, "message" => "Your note is not pined, Please retry..."]);
        }
    }
    public function showAllPinNotes()
    {
        $pinNotes = PinNote::with("note")->where("user_id", auth()->user()->id)->get();
        dd($pinNotes->toArray());
        if (!$pinNotes->isEmpty()) {
            return response()->json(["status" => 200, "data" => $pinNotes]);
        } else {
            return response()->json(["status" => 404, "data" => "No Recodrd found for this user"]);
        }
    }

    public function Notecomments(Request $request)
    {
        $comment = new NoteComment();
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
        $comment->note_id = $request->note_id;
        if ($comment->save()) {
            return response()->json(["status" => 200, "data" => $comment]);
        } else {
            return response()->json(["status" => 402, "data" => "Some thing wrong"]);
        }
    }
    public function CommentsOnNote($id){
        $CommentsOnNote=ItemComment::where("item_id", $id)->get();
        if(!$CommentsOnNote->isEmpty()){
            return response()->json(["status" => 200, "data" => $CommentsOnNote]);
        }
        else{
            return response()->json(["status" => 404, "data" => "There is not comments for this note"]);
        }
    }
    public function Itemcomments(Request $request)
    {
        $comment = new ItemComment();
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
        $comment->item_id = $request->item_id;
        if ($comment->save()) {
            return response()->json(["status" => 200, "data" => $comment]);
        } else {
            return response()->json(["status" => 402, "data" => "Some thing wrong"]);
        }
    }

    public function commentReply()
    {
        return "commentReply";
    }

    public function singleNote($id){
        $note=Note::where("id",$id)->with("item")->get();
        if(!$note->isEmpty()){
            return response()->json(["status" =>200, "data" =>$note]);
        }
        else{
            return response()->json(["status" =>404, "data" =>"Not is not found"]);
        }
    }

    public function updateItemStatus($id){
        $item=Item::where('id',$id)->first();
        if (!$item->status){
            Item::where('id',$id)->update(['status' => 1]);
            return response()->json(["status" => 200, "res" => 1]);
        }
        if($item->status){
            Item::where('id',$id)->update(['status' => 0]);
            return response()->json(["status" => 200, "res" => 0]);
        }
         else {
            
            return response()->json(["status" => 400, "message" => "Your item status is not updated, Please retry..."]);
        }
    }
    public function arrangeItem(Request $request){
        // return count($request->list);

        for($i=0; $i < count($request->list); $i++){
                // $item= Item::where("note_id",1)->delete();
        }
        
    //     dd($item);
    //  return response()->json(["status" => 200, "message" => $request->id]);
    }

    public function sortItem(){
        
    }
}

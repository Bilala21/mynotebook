<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_comments', function (Blueprint $table) {
            $table->id();
            $table->text("body")->nullable();
            $table->foreignId("note_id")->constrained("notes")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_comments');
    }
}

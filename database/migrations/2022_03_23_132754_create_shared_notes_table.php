<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("note_id")->constrained("notes")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("receiver_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('shared_notes');
    }
}

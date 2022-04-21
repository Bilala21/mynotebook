<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("note_id")->nullable()->constrained("notes")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('pin_notes');
    }
}

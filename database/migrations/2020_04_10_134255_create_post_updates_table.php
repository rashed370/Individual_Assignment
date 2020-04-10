<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('postid');
            $table->string('place', 255);
            $table->text('details');
            $table->string('country', 100);
            $table->string('genre', 100);
            $table->string('medium', 155);
            $table->string('cost', 55);
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
        Schema::dropIfExists('post_updates');
    }
}

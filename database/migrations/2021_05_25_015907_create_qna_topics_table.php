<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQnaTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qna_topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
             $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('topic_title')->nullable();
            $table->string('topic_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qna_topics');
    }
}
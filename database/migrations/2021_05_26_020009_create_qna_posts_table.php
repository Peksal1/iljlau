<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQnaPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qna_posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
           /// $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->unsignedBigInteger('topic_id');
            $table->foreignId('topic_id')->references('id')->on('qna_topics')->onDelete('cascade');
            $table->string('post_text')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qna_posts');
    }
}
/**
 *http://127.0.0.1:8000/qna
 * press on topic
 * redirect in http://127.0.0.1:8000/topic/(id)
 * get the id
 * get a table for the id
 * 
 */
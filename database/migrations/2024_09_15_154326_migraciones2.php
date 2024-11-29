<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        /*
        Schema::create('category_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->unique(['category_id', 'tag_id']);
        });
        */
        Schema::create('categories',function(BluePrint $table){
            $table->id();
            $table->string('name');
            $table->timeStamps();
        });

        Schema::create('tags',function(BluePrint $table){
            $table->id();
            $table->string('name');
            $table->timeStamps();
        });
        //
        Schema::create('blogs',function(BluePrint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            /*$table->string('name');*/
            $table->string('title');
            $table->text('content');
            $table->integer('visitors')->default(0);
            $table->string('image_path')->nullable();
            $table->timeStamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('blog_tags',function(BluePrint $table){
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('blog_id');
            $table->timeStamps();

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('blog_id')->references('id')->on('blogs');
        });
/*
        Schema::create('comments',function(BluePrint $table){
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->timeStamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};

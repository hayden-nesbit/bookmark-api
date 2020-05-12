<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text("unique")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("tag_id");
            $table->text("title")->nullable();;
            $table->text("author")->nullable();;
            $table->text("description")->nullable();;
            $table->integer("pageCount")->default(0);
            $table->text("category")->nullable();;
            $table->text("image")->nullable();;
            $table->text("publisher")->nullable();;
            $table->text("pubDate")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tag_id')->references('id')->on('user_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}

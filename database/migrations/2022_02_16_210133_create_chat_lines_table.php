<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained()->references('id')->on('chats')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('from_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('to_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unique(['from_user_id','to_user_id']);
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
        Schema::dropIfExists('chat_lines');
    }
}

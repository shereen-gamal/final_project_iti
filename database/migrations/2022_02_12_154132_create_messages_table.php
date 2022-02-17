<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content',255);
            $table->foreignId('chat_id')->constrained()->references('id')->on('chats')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('from_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('to_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('messages');
    }
}

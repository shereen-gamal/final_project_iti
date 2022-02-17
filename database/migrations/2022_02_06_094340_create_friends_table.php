<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreignId('friend_id')
            ->nullable()
            ->constrained()
            ->references('id')->on('users')->onDelete('cascade')
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
        Schema::dropIfExists('friends');
    }
}

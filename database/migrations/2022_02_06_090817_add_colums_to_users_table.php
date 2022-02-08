<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('userid');
            $table->string('firstname');
            $table->string('lasttname');

            $table->string('school');
            $table->string('address',255);

            $table->string('profilePic',255);
            $table->string('mobile');

            $table->string('location');
            $table->boolean('isAdmin');

            $table->date('date_of_birth');
            $table->string('gender');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

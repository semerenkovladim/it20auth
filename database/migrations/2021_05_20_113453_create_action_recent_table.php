<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionRecentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_recent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modify_password_id')->nullable();
            $table->foreignId('modify_twostep_id')->nullable();
            $table->foreignId('modify_reserved_password_id')->nullable();
            $table->foreignId('modify_reserved_email_id')->nullable();
            $table->foreignId('modify_notification_id')->nullable();
            $table->foreignId('modify_codeword_id')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('action_recent');
    }
}

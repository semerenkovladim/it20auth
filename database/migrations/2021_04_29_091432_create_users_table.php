<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('position', 255);
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('middle_name', 100);
            $table->text('avatar')->nullable();
            $table->date('birth');
            $table->date('date_start');
            $table->string('email', 255)->unique();
            $table->string('mobile_phone', 255)->nullable();
            $table->string('work_phone', 255)->nullable();
            $table->string('skype', 255)->unique()->nullable();
            $table->string('password', 255);
            $table->string('remember_token', 255)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->foreignId('department_id');
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
        Schema::dropIfExists('users');
    }
}

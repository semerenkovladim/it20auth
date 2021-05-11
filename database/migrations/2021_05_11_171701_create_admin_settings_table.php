<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('surname')->default(true);
            $table->boolean('name')->default(true);
            $table->boolean('patronymic')->default(true);
            $table->boolean('email')->default(true);
            $table->boolean('position')->default(true);
            $table->boolean('department')->default(true);
            $table->boolean('date_of_birth')->default(true);
            $table->boolean('modules')->default(true);
            $table->boolean('role')->default(true);
            $table->integer('user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValuesToAccessLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_levels', function (Blueprint $table) {
            $table->boolean('account')->default(false)->change();
            $table->boolean('disk')->default(false)->change();
            $table->boolean('mail')->default(false)->change();
            $table->boolean('calendar')->default(false)->change();
            $table->boolean('photo')->default(false)->change();
            $table->boolean('contacts')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_levels', function (Blueprint $table) {
            $table->boolean('account')->change();
            $table->boolean('disk')->change();
            $table->boolean('mail')->change();
            $table->boolean('calendar')->change();
            $table->boolean('photo')->change();
            $table->boolean('contacts')->change();
        });
    }
}

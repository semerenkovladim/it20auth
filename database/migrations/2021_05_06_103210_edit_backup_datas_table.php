<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditBackupDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('backup_datas', function (Blueprint $table) {
            $table->string('backup_password')->nullable()->change();
            $table->string('backup_email')->nullable()->change();
            $table->string('code_word')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('backup_datas', function (Blueprint $table) {
            $table->string('backup_password')->change();
            $table->string('backup_email')->change();
            $table->string('code_word')->change();
        });
    }
}

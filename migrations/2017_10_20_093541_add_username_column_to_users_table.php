<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!$table->hasColumn('username')) {
                $table->string('username')->unique();
            }

            $table->boolean('superadmin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Since "username" is very likely to be present before running this migration, we are leaving it untouched
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['superadmin']);
        });
    }
}

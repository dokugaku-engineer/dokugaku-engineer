<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes()->after('email');
            $table->boolean('existence')->nullable()->storedAs('CASE WHEN deleted_at IS NULL THEN 1 ELSE NULL END')->after('deleted_at');

            $table->dropUnique('users_username_unique');
            $table->dropUnique('users_email_unique');

            $table->unique(['username', 'existence']);
            $table->unique(['email', 'existence']);
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
            $table->dropColumn('existence');
            $table->dropSoftDeletes();
        });
    }
}

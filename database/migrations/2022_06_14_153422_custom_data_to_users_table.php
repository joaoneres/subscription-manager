<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('email_verified_at');
            $table->timestamp('phone_verified_at')->after('phone')->nullable();
            $table->string('document')->after('phone_verified_at');
            $table->boolean('is_admin')->after('document')->default(0);
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
            $table->dropColumn('is_admin');
            $table->dropColumn('document');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('phone');
        });
    }
}

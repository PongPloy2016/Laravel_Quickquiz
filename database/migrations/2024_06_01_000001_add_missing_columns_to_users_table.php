<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'mobile_2')) {
                $table->string('mobile_2')->nullable()->after('mobile');
            }
            if (!Schema::hasColumn('users', 'school')) {
                $table->string('school')->nullable()->after('city');
            }
            if (!Schema::hasColumn('users', 'percent_10')) {
                $table->string('percent_10')->nullable()->after('school');
            }
            if (!Schema::hasColumn('users', 'percent_11')) {
                $table->string('percent_11')->nullable()->after('percent_10');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile_2', 'school', 'percent_10', 'percent_11']);
        });
    }
}

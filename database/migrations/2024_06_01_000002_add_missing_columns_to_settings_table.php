<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'w_email')) {
                $table->string('w_email')->nullable();
            }
            if (!Schema::hasColumn('settings', 'currency_code')) {
                $table->string('currency_code')->nullable();
            }
            if (!Schema::hasColumn('settings', 'currency_symbol')) {
                $table->string('currency_symbol')->nullable();
            }
            if (!Schema::hasColumn('settings', 'google_login')) {
                $table->boolean('google_login')->default(0);
            }
            if (!Schema::hasColumn('settings', 'fb_login')) {
                $table->boolean('fb_login')->default(0);
            }
            if (!Schema::hasColumn('settings', 'gitlab_login')) {
                $table->boolean('gitlab_login')->default(0);
            }
            if (!Schema::hasColumn('settings', 'right_setting')) {
                $table->boolean('right_setting')->default(0);
            }
            if (!Schema::hasColumn('settings', 'element_setting')) {
                $table->boolean('element_setting')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'w_email', 'currency_code', 'currency_symbol',
                'google_login', 'fb_login', 'gitlab_login',
                'right_setting', 'element_setting'
            ]);
        });
    }
}

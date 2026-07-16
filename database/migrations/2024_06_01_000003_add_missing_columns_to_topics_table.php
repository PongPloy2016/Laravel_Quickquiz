<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToTopicsTable extends Migration
{
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            if (!Schema::hasColumn('topics', 'show_ans')) {
                $table->boolean('show_ans')->default(0)->after('timer');
            }
            if (!Schema::hasColumn('topics', 'amount')) {
                $table->decimal('amount', 10, 2)->nullable()->after('show_ans');
            }
        });
    }

    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn(['show_ans', 'amount']);
        });
    }
}

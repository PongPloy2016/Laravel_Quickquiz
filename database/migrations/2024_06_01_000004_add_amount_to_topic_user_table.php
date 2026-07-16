<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountToTopicUserTable extends Migration
{
    public function up()
    {
        Schema::table('topic_user', function (Blueprint $table) {
            if (!Schema::hasColumn('topic_user', 'amount')) {
                $table->decimal('amount', 10, 2)->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('topic_user', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
}

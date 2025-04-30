<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('goal_reward_id')->nullable()->after('points');
        $table->foreign('goal_reward_id')->references('id')->on('rewards')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['goal_reward_id']);
        $table->dropColumn('goal_reward_id');
    });
}

};

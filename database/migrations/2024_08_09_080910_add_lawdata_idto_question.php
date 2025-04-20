<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'questions',
            function (Blueprint $table) {
                $table->integer('lawdata_id')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('questions', 'lawdata_id')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropColumn('lawdata_id');
            });
        }
    }
};

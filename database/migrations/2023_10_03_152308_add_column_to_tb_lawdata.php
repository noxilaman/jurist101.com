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
        Schema::table('tb_lawdata', function (Blueprint $table) {
            $table->text('short_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tb_lawdata', 'short_note')) {
            Schema::table('tb_lawdata', function (Blueprint $table) {
                $table->dropColumn('short_note');
            });
        }
    }
};

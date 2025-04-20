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
            'tb_app',
            function (Blueprint $table) {
                $table->string('group_app')->nullable();
                $table->string('icon_app')->nullable();
                $table->string('short_name')->nullable();
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
        if (Schema::hasColumn('tb_app', 'group_app')) {
            Schema::table('tb_app', function (Blueprint $table) {
                $table->dropColumn('group_app');
            });
        }
        if (Schema::hasColumn('tb_app', 'icon_app')) {
            Schema::table('tb_app', function (Blueprint $table) {
                $table->dropColumn('icon_app');
            });
        }
        if (Schema::hasColumn('tb_app', 'short_name')) {
            Schema::table('tb_app', function (Blueprint $table) {
                $table->dropColumn('short_name');
            });
        }
    }
};

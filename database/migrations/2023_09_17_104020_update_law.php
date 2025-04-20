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
            'tb_lawdata',
            function (Blueprint $table) {
                $table->string('important_keys')->nullable();
                $table->text('internal_factor')->nullable();
                $table->text('external_factor')->nullable();
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
        if (Schema::hasColumn('tb_lawdata', 'important_keys')) {
            Schema::table('tb_lawdata', function (Blueprint $table) {
                $table->dropColumn('important_keys');
            });
        }
        if (Schema::hasColumn('tb_lawdata', 'internal_factor')) {
            Schema::table('tb_lawdata', function (Blueprint $table) {
                $table->dropColumn('internal_factor');
            });
        }
        if (Schema::hasColumn('tb_lawdata', 'external_factoer')) {
            Schema::table('tb_lawdata', function (Blueprint $table) {
                $table->dropColumn('external_factor');
            });
        }
    }
};

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
                $table->string('version')->nullable();
                $table->timestamps();
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
        if (Schema::hasColumn('tb_app', 'version')) {
            Schema::table('tb_app', function (Blueprint $table) {
                $table->dropColumn('version');
                $table->timestamps();
            });
        }
    }

};

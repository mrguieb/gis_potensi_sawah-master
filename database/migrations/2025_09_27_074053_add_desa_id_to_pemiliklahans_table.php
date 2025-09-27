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
        Schema::table('pemiliklahans', function (Blueprint $table) {
            // Add desa_id column and set foreign key to desas.id
            $table->unsignedBigInteger('desa_id')->nullable()->after('id');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemiliklahans', function (Blueprint $table) {
            // Drop foreign key and column on rollback
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });
    }
};

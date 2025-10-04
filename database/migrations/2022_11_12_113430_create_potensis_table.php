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
        Schema::create('farmland', function (Blueprint $table) {
            $table->id();
            $table->integer('barangay_id');
            $table->integer('farmer_id');
            $table->integer('crop_id');
            $table->integer('land_area');
            $table->text('land_boundaries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmland');
    }
};

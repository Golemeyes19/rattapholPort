<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->boolean('menu_id');
            $table->string('name_th', 500);
            $table->string('name_en', 500);
            $table->longText('description_th');
            $table->longText('description_en');
            $table->string('image', 700)->nullable();
            $table->string('image_2', 700)->nullable();
            $table->string('image_3', 700)->nullable();
            $table->integer('sequence')->comment = 'ลำดับในการแสดงผล';
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('banner');
    }
}

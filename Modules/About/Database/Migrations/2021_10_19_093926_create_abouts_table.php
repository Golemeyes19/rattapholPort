<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('about', function (Blueprint $table) {
          $table->id();
          $table->string('name_th',500);
          $table->string('name_en',500);
          $table->string('name1_th',500);
          $table->string('name1_en',500);
          $table->string('name2_th',500);
          $table->string('name2_en',500);
          $table->text('description_on_th')->nullable();
          $table->text('description_on_en')->nullable();
          $table->text('description_center_th')->nullable();
          $table->text('description_center_en')->nullable();
          $table->text('description_lower_th')->nullable();
          $table->text('description_lower_en')->nullable();
          $table->string('image_top', 700)->nullable();
          $table->string('image_on', 700)->nullable();
          $table->string('image_center', 700)->nullable();
          $table->string('image_lower', 700)->nullable();
          $table->string('video_1', 700)->nullable();
          $table->string('video_2', 700)->nullable();
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
        Schema::dropIfExists('abouts');
    }
}

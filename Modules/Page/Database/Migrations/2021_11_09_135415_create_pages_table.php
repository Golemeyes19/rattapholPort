<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name_th', 500)->nullable();
            $table->string('name_en', 500)->nullable();
            $table->string('description_th', 500)->nullable();
            $table->string('description_en', 500)->nullable();
            $table->mediumText('detail_th')->nullable();
            $table->mediumText('detail_en')->nullable();
            $table->string('image', 700)->nullable();
            $table->string('meta_title_th')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_key_th')->nullable();
            $table->string('meta_key_en')->nullable();
            $table->string('meta_description_th')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('params', 700)->nullable();
            $table->boolean('status')->default(0);
            $table->integer('sequence')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}

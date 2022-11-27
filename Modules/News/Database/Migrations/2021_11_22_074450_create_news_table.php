<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('name_th', 500);
            $table->string('name_en', 500);
            $table->text('description_th');
            $table->text('description_en');
            $table->string('slug_th', 255)->nullable();
            $table->string('slug_en', 255)->nullable();
            $table->string('image', 700);
            $table->string('params', 700)->nullable();
            $table->boolean('status')->default(0);
            $table->integer('sequence');
            $table->integer('id_news_category');
            $table->integer('author')->nullable()->comment = 'ผู้เขียน';
            $table->dateTime('publish_at')->comment = 'วันที่กำหนดให้เผยแพร่';
            $table->timestamps();
        });

        Schema::create('news_category', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name_th', 255);
            $table->string('name_en', 255);
            $table->string('description_th', 700)->nullable();
            $table->string('description_en', 700)->nullable();
            $table->text('image_th')->nullable();
            $table->text('image_en')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug_th', 255)->nullable();
            $table->string('slug_en', 255)->nullable();
            NestedSet::columns($table);
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
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_category');
    }
}

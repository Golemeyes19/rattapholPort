<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdpa', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('pdpa_title_th', 700);
            $table->string('pdpa_title_en', 700);
            $table->text('pdpa_detail_th');
            $table->text('pdpa_detail_en');
            $table->text('pdpa_detail_long_th');
            $table->text('pdpa_detail_long_en');
            $table->boolean('status', 1)->default(0);
            $table->integer('created_by')->index();
            $table->dateTime('created_at');
            $table->integer('updated_by')->index();
            $table->dateTime('updated_at');
        });

        Schema::create('pdpa_detail', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('member_id')->index();
            $table->string('pdpa_ip', 100);
            $table->text('pdpa_user_agent');
            $table->boolean('pdpa_user_status');
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
        Schema::dropIfExists('pdpa');
        Schema::dropIfExists('pdpa_detail');
    }
}

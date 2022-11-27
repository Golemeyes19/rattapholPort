<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactusTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->dateTime('create_date');
            $table->string('name', 250);
            $table->string('subject', 200);
            $table->text('message');
            $table->text('reply')->nullable();
            $table->tinyInteger('status')->length(2)->default(0)->comment('0=ยังไม่ได้ตอบ, 1=ตอบแล้ว');
            $table->dateTime('modify_date')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_page', function (Blueprint $table) {
            $table->id();
            $table->text('description_th')->nullable();
            $table->text('description_en')->nullable();
            $table->string('head_office_th', 500)->nullable();
            $table->string('head_office_en', 500)->nullable();
            $table->string('factory_th', 500)->nullable();
            $table->string('factory_en', 500)->nullable();
            $table->string('fb', 200)->nullable();
            $table->string('line', 200)->nullable();
            $table->string('youtube', 200)->nullable();
            $table->string('phone_head_office', 10)->nullable();
            $table->string('phone_factory', 10)->nullable();
            $table->string('email_head_office', 250)->nullable();
            $table->string('email_factory', 250)->nullable();
            $table->string('gmaps', 500)->nullable();
            $table->timestamps();
        });

        Schema::create('contact_subject', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 500)->nullable();
            $table->string('to_email', 500)->nullable();
            $table->string('cc_email', 500)->nullable();
            $table->string('sequence', 500)->nullable();
            $table->string('status', 200)->nullable();
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
        Schema::dropIfExists('contact');
        Schema::dropIfExists('contact_page');
        Schema::dropIfExists('contact_subject');

    }
}

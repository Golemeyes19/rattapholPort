<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websetting', function (Blueprint $table) {
            $table->id();
            $table->string('companyname_th', 250);
            $table->string('companyname_en', 250);
            $table->string('link_login', 200)->nullable();
            // $table->string('phone_head_office', 10)->nullable();
            // $table->string('phone_factory', 10)->nullable();
            $table->string('fb', 200)->nullable();
            $table->string('line', 200)->nullable();
            $table->string('youtube', 200)->nullable();
            // $table->string('email_head_office', 250);
            // $table->string('email_factory', 250);
            $table->text('our_story_th')->nullable();
            $table->text('our_story_en')->nullable();
            $table->string('head_office_th', 250)->nullable();
            $table->string('head_office_en', 250)->nullable();
            $table->string('factory_th', 250)->nullable();
            $table->string('factory_en', 250)->nullable();
            $table->string('logo_header', 200)->nullable();
            $table->string('logo_footer', 200)->nullable();
            $table->text('privacy_th')->nullable();
            $table->text('privacy_en')->nullable();
            $table->string('meta_title', 250)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('seo_image', 250)->nullable();
            $table->text('google_analytics')->nullable();
            // $table->string('gmaps', 500);
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
        Schema::dropIfExists('websetting');
    }
}

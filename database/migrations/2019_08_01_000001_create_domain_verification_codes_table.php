<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainVerificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_verification_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('verifiable_id')->index();
            $table->string('site')->index();
            $table->string('token')->index();
            $table->smallInteger('status')->default(10);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_verification_codes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('verifiable_type')->index();
            $table->integer('verifiable_id')->index();
            $table->string('url')->index();
            $table->string('token')->index();
            $table->string('activation_token')->index();
            $table->enum('status', ['pending', 'verified'])->default('pending')->index();
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('domain_verifications');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('verifiable_id')->index();
            $table->string('url')->index();
            $table->string('token')->index();
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

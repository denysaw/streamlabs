<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOAuthProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_providers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('provider_user_id');
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->foreignUlid('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oauth_providers');
    }
}

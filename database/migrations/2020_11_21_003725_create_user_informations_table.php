<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_informations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->string('friend_code')->unique();
            $table->string('contact_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('adresse')->nullable();
            $table->text('biography')->nullable();
            $table->text('job')->nullable();
            $table->text('diploma')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->text('interests')->nullable();
            $table->string('avatar')->default('user_default.png');
            $table->timestamps();
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_informations');
    }
}

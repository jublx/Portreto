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
            $table->string('contact_email');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('adresse');
            $table->text('biography');
            $table->text('job');
            $table->text('diploma');
            $table->string('linkedin');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('facebook');
            $table->text('interests');
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

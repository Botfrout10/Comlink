<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('organisation');
            $table->string('nom');
            $table->string('prenom');
            $table->string('address');
            $table->string('email');
            $table->string('tel');
            $table->string('remarque');
            $table->string('date_premier_contact')->nullable();
            $table->string('status_act')->nullable();
            $table->string('source_prospect');
            $table->string('count_appel')->nullable();
            $table->foreignId('commercial_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('prospects');
    }
};

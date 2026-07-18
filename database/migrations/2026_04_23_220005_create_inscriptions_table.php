<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('district_id')->index();
            $table->string('nid');
            $table->string('name');
            $table->string('cellphone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('attached')->nullable();
            $table->foreignId('user_id')->index();
            $table->foreignId('team_id')->index();
            $table->integer('additional');
            $table->timestamps();
            $table->unique(['event_id', 'nid', 'email'], 'uidx_event_nid_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};

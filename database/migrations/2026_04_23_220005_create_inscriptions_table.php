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
            $table->string('nid')->unique();
            $table->string('name');
            $table->string('cellphone');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('attached');
            $table->foreignId('user_id')->index();
            $table->foreignId('team_id')->index();
            $table->integer('additional');
            $table->timestamps();
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

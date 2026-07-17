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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->string('description')->nullable();;
            $table->date('start');
            $table->date('finish');
            $table->tinyInteger('active')->default(1);
            $table->integer('quota_by_district')->default(0);
            $table->integer('quota_additional')->default(0);
            $table->integer('quota_max')->default(0);
            $table->integer('active_inscription')->default(0);
            $table->foreignId('role_id')->index();
            $table->foreignId('team_id')->index();
            $table->foreignId('district_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

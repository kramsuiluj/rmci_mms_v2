<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained('schedules', 'id')->cascadeOnDelete();
            $table->string('module')->nullable();
            $table->string('filename')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('is_displayed')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'schedule_id', 'filename']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->boolean('status')->default(0);
            $table->date('last_update')->nullable();
            $table->date('deadline')->nullable();
            $table->text('comment')->nullable();
            $table->integer('completion_percentage')->default(0);

            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('developer_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->boolean('is_completed')->default(false);
            $table->date('tanggal')->nullable(); // 🆕 Tanggal tugas
            $table->enum('status', ['penting', 'kurang penting', 'tidak penting'])->default('tidak penting'); // 🆕 Status
            $table->string('assigned_to')->nullable(); // 🆕 Optional untuk advance
            $table->string('role')->nullable(); // 🆕 Optional untuk advance
            $table->timestamps();
        });
    }

};

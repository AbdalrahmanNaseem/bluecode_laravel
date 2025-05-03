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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');
            $table->text('scenario')->nullable();
            $table->text('investigation_questions')->nullable();
            $table->string('image')->nullable();
            $table->string('vm_download_link')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->integer('points')->default(0);
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');;


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};

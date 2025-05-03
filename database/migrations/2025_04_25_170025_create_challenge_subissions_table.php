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
        Schema::create('challenge_subissions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');;
            $table->foreignIdFor(\App\Models\Challenge::class);
            $table->text('report_file_path');
            $table->string('status')->default('pending')->comment('one of: pending, accepted, rejected');
            $table->text('admin_feedback')->nullable();
            $table->timestamp('submitted_at')->useCurrent();





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_subissions');
    }
};

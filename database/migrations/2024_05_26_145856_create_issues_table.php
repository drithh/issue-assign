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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('findings');
            $table->string('criteria');
            $table->string('requirements');
            $table->string('root_cause_analysis');
            $table->string('corrective_actions');
            $table->timestamp('target_time');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');

            $table->text('resolution_description')->nullable();
            $table->string('file_url')->nullable();
            $table->foreignId('submitted_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamp('submitted_at')->nullable();

            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};

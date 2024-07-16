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
            $table->string('status')->default('pending');

            $table->string('findings');
            $table->string('criteria');
            $table->string('additonal_data');
            // $table->string('root_cause_analysis');
            // $table->string('corrective_actions');
            $table->timestamp('target_time');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');

            $table->timestamp('target_time')->nullable();
            $table->string('resolution_description')->nullable();
            $table->text('corrective_actions')->nullable();
            $table->text('root_cause_analysis')->nullable();
            $table->text('preventive_actions')->nullable();
            $table->text('file_url')->nullable();

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

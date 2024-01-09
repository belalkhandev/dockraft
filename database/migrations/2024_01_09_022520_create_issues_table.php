<?php

use App\Enums\IssueStatus;
use App\Enums\IssueTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('summary');
            $table->text('description')->nullable();
            $table->enum('type', IssueTypes::values())->default(IssueTypes::TASK->value);
            $table->enum('status', IssueStatus::values())->default(IssueStatus::TODO->value);
            $table->unsignedBigInteger('parent_task_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};

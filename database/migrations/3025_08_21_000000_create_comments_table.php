<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->bigInteger('vote_up')->default(0);
            $table->bigInteger('vote_down')->default(0);
            $table->text('attachments')->nullable();

            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();

            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();

            // Add indexes for improved query performance
            $table->index('user_id');
            $table->index('post_id');
            $table->index('parent_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

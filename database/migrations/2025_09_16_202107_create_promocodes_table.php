<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type');
            $table->decimal('value', 8, 2);
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('active_at')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->json('product_ids')->nullable();
            $table->json('user_ids')->nullable();
            $table->integer('max_count_per_user')->default(1); // -1 for
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};

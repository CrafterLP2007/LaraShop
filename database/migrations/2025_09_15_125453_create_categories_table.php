<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('slug')->unique();
            $table->integer('order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

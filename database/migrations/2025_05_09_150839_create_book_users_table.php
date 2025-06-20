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
        Schema::create('book_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numberOfCopies');
            $table->boolean('bought')->default(false);
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('book_users');
    }
};

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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('isBn')->nullable();
            $table->string('coverImage');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('publishYear');
            $table->unsignedBigInteger('numberOfPages');
            $table->unsignedBigInteger('numberOfCopies')->nullable();
            $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->foreignId('publisher_id')
                    ->constrained('publishers')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

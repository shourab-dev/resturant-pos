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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('detail')->nullable();
            $table->date('start_date')->default(now());
            $table->date('end_date')->nullable();
            $table->enum('type', ['fixed', 'percentage', 'buyToFree'])->default('fixed');
            $table->integer('amount');
            $table->enum('discount_by', ['all', 'product', 'productExclude', 'category', 'categoryExclude'])->default('all');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

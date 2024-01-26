<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->text('comment')->nullable()->change();
            $table->integer('rating')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->text('comment')->nullable(false)->change();
            $table->integer('rating')->nullable(false)->change();
        });
    }
};

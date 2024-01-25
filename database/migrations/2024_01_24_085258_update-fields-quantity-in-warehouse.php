<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->integer('quantity_sold')->nullable();
            $table->integer('in_stock')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->dropColumn('quantity_sold');
            $table->dropColumn('in_stock');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->integer('import_quantity')->default(100)->nullable();
            $table->dropColumn('in_stock');
        });
    }

    public function down(): void
    {
        Schema::table('product_warehouses', function (Blueprint $table) {
            $table->integer('in_stock')->nullable();
            $table->dropColumn('import_quantity');
        });
    }
};

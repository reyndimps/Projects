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
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_order_id')->after('id');
            $table->unsignedBigInteger('inventory_id')->after('sales_order_id');
            $table->index('sales_order_id');
            $table->index('inventory_id');
            $table->foreign('sales_order_id')->references('id')->on('sales_order')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            //
        });
    }
};

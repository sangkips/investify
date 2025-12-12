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
        Schema::table('quotations', function (Blueprint $table) {
            $table->decimal('total_amount', 12, 2)->change();
            $table->decimal('shipping_amount', 12, 2)->change();
            $table->decimal('tax_amount', 12, 2)->nullable()->change();
            $table->decimal('discount_amount', 12, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->integer('total_amount')->change();
            $table->integer('shipping_amount')->change();
            $table->integer('tax_amount')->nullable()->change();
            $table->integer('discount_amount')->nullable()->change();
        });
    }
};

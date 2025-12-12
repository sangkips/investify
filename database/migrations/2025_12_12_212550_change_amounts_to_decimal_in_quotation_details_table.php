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
        Schema::table('quotation_details', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->change();
            $table->decimal('unit_price', 12, 2)->change();
            $table->decimal('sub_total', 12, 2)->change();
            $table->decimal('product_discount_amount', 12, 2)->change();
            $table->decimal('product_tax_amount', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotation_details', function (Blueprint $table) {
            $table->integer('price')->change();
            $table->integer('unit_price')->change();
            $table->integer('sub_total')->change();
            $table->integer('product_discount_amount')->change();
            $table->integer('product_tax_amount')->change();
        });
    }
};

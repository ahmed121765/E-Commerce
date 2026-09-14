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
        Schema::table('products', function (Blueprint $table) {
            $table->text('why_choose_product')->nullable()->after('description');
            $table->text('sample_number_list')->nullable()->after('why_choose_product');
            $table->text('lining')->nullable()->after('sample_number_list');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'why_choose_product',
                'sample_number_list',
                'lining',
            ]);
        });
    }
};

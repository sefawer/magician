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
        //
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('month');
            $table->string('products');
            $table->float('min_order_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('campaigns');
    }
};

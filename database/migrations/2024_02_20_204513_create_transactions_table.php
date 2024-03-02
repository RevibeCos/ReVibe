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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->char('type',1);
            $table->decimal('amount', 10, 2);
            $table->decimal('total', 10, 2); // Add new total column
            $table->decimal('vat', 10, 2); // Add new vat column
            $table->date('date');
            $table->decimal('discount', 10, 2)->default(0); // Add new discount column with default value of 0
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

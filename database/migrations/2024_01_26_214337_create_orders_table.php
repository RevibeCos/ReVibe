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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->char('status',1);
            $table->string('comment');

            $table->char('payment_method',2);
            $table->char('payment_status',2);
            $table->char('delivery_method',2);
            $table->string('delivery_pickup_interval');
            $table->date('paid_at');
            $table->date('shipped_at');
            $table->date('complete_at');
            $table->string('number_of_packages')->nullable();





            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

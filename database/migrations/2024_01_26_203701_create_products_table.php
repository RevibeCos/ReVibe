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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //add properties
            // way use
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('hover_image')->nullable();
            $table->json('images')->nullable();
            $table->string('cost_price');
            $table->string('full_price');
            $table->string('website_price');
            $table->double('discount')->nullable();
            $table->char('is_new',1)->default(1);
            $table->char('is_sail',1)->default(0);
            $table->char('is_instagram',0)->default(0);
            $table->integer('sort_order');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

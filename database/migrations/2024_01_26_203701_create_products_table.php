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
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->longText('description')->nullable();
            $table->json('how_to_use')->nullable();
            $table->string('image');
            $table->string('hover_image')->nullable();
            $table->string('cost_price');
            $table->string('full_price');
            $table->string('website_price');
            $table->double('discount')->nullable();
            $table->char('is_new',1)->default(1);
            $table->char('is_sail',1)->default(0);
            $table->char('in_home',1)->default(0);
            $table->char('is_instagram',1)->default(0);
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

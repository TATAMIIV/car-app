<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('brand');
            $table->string('name');
            $table->integer('year');
            $table->string('body_type');
            $table->decimal('base_price', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->string('deletion_reason')->nullable();
            $table->text('deletion_detail')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained('banks')->cascadeOnDelete();
            $table->string('product_id')->unique();
            $table->string('product_name');
            $table->string('logo');
            $table->string('link');
            $table->decimal('fees', 8, 2)->default(0);
            $table->decimal('tae', 5, 2)->default(0);
            $table->decimal('annual_fee_first_year', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};

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
            $table->string('code', 20);
            $table->timestamp('deleted_at');
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('address_payment', 255);
            $table->string('email_payment', 255);
            $table->string('name_payment', 255);
            $table->string('phone_payment', 255);
            $table->string('note_payment', 255);
            $table->double('total_cart');
            $table->timestamps();
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

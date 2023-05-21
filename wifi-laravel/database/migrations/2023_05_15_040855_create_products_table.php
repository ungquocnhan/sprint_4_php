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
            $table->string('code', 10);
            $table->integer('quantity_exists');
            $table->text('description');
            $table->string('name', 255);
            $table->double('price');
            $table->string('size', 255);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('flag_promoted')->default(1);
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->foreignId('coverage_density_id')->constrained('coverage_density');
            $table->foreignId('frequency_band_id')->constrained('frequency_band');
            $table->foreignId('guarantee_id')->constrained('guarantee');
            $table->foreignId('made_in_id')->constrained('made_in');
            $table->foreignId('manufacture_id')->constrained('manufacture');
            $table->foreignId('promotion_id')->constrained('promotion');
            $table->foreignId('speed_wifi_id')->constrained('speed_wifi');
            $table->foreignId('standard_network_id')->constrained('standard_network');
            $table->foreignId('type_anteing_id')->constrained('type_anteing');
            $table->foreignId('type_device_id')->constrained('type_device');
            $table->foreignId('user_connect_id')->constrained('user_connect');
            $table->foreignId('button_support_id')->constrained('button_support');
            $table->foreignId('port_id')->constrained('port');
            $table->foreignId('anteing_id')->constrained('anteing');
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

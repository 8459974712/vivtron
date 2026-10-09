<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('charging_stations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('station_name')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index(['latitude', 'longitude']);
            $table->index(['status', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('charging_stations');
    }
};

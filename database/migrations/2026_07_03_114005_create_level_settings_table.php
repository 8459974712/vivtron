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
    Schema::create('level_settings', function (Blueprint $table) {
        $table->id();
        $table->integer('level_no');
        $table->decimal('percentage', 8, 2);
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_settings');
    }
};

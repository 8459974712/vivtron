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
    Schema::create('reward_settings', function (Blueprint $table) {
        $table->id();

        $table->string('rank_name');
        $table->integer('required_sales');
        $table->decimal('reward_amount', 12, 2);

        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_settings');
    }
};

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
    Schema::create('user_royalties', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->foreignId('royalty_setting_id')
              ->constrained()
              ->onDelete('cascade');

        $table->decimal('amount', 12, 2)->default(0);

        $table->dateTime('achieved_on')->nullable();

        $table->string('status')->default('paid');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_royalties');
    }
};

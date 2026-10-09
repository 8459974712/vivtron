<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('product_name')->nullable();

            $table->decimal('sale_value', 15, 2)->default(0);

            $table->enum('status', [
                'pending',
                'approved',
                'operational',
                'rejected'
            ])->default('pending');

            $table->unsignedBigInteger('approved_by')->nullable();

            $table->date('operational_date')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('purchases', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id');

        $table->foreignId('product_id');

        $table->string('full_name');
        $table->string('email');
        $table->string('mobile');
        $table->string('pan_number')->nullable();
        $table->string('gst_number')->nullable();

        $table->string('sponsor_id')->nullable();
        $table->string('enroll_id')->nullable();

        $table->string('state')->nullable();

        $table->string('payment_method')->nullable();
        $table->string('payer_name')->nullable();
        $table->string('account_number')->nullable();
        $table->string('transaction_number')->nullable();

        $table->string('slip')->nullable();

        $table->decimal('amount',10,2)->default(0);

        $table->enum('status',['pending','approved','rejected'])
              ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

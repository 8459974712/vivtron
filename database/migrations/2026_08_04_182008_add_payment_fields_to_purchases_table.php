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
    Schema::table('purchases', function (Blueprint $table) {

        $table->string('bank_name')->nullable()->after('payer_name');

        $table->date('payment_date')->nullable()->after('transaction_number');

        $table->decimal('payment_amount',10,2)
              ->nullable()
              ->after('payment_date');

        $table->enum('payment_type',['full','half'])
              ->nullable()
              ->after('payment_amount');

    });
}

public function down()
{
    Schema::table('purchases', function (Blueprint $table) {

        $table->dropColumn([
            'bank_name',
            'payment_date',
            'payment_amount',
            'payment_type'
        ]);

    });
}

  
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rank_settings', function (Blueprint $table) {
            $table->id();

            $table->string('rank_name');

            $table->integer('required_sales');

            $table->decimal('incentive_percentage', 8, 2)
                  ->default(0);

            $table->boolean('status')
                  ->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rank_settings');
    }
};
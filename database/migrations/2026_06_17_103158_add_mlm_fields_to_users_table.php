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
        Schema::table('users', function (Blueprint $table) {

            $table->string('referral_code')->unique()->nullable()->after('role');

            $table->unsignedBigInteger('sponsor_id')->nullable()->after('referral_code');

            $table->enum('status', ['active', 'inactive'])
                  ->default('active')
                  ->after('sponsor_id');

            $table->string('rank')
                  ->default('Member')
                  ->after('status');

            $table->date('joining_date')
                  ->nullable()
                  ->after('rank');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'referral_code',
                'sponsor_id',
                'status',
                'rank',
                'joining_date'
            ]);

        });
    }
};
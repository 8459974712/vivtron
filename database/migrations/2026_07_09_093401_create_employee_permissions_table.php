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
    Schema::create('employee_permissions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');

        $table->boolean('users_access')->default(false);
        $table->boolean('kyc_access')->default(false);
        $table->boolean('sales_access')->default(false);
        $table->boolean('income_access')->default(false);
        $table->boolean('withdrawal_access')->default(false);
        $table->boolean('reward_access')->default(false);
        $table->boolean('bank_access')->default(false);
        $table->boolean('rank_access')->default(false);
        $table->boolean('reward_setting_access')->default(false);
        $table->boolean('royalty_access')->default(false);
        $table->boolean('level_access')->default(false);
        $table->boolean('export_access')->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_permissions');
    }
};

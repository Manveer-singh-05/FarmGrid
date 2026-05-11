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
        Schema::table('electricity_schedules', function (Blueprint $table) {
            $table->string('day_of_week')->nullable()->after('end_time');
            $table->integer('allocation_percentage')->default(100)->after('day_of_week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electricity_schedules', function (Blueprint $table) {
            $table->dropColumn(['day_of_week', 'allocation_percentage']);
        });
    }
};

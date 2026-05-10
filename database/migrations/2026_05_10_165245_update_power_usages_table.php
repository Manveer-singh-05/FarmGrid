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
        Schema::table('power_usages', function (Blueprint $table) {
            // Rename units_used to units_consumed if it exists
            if (Schema::hasColumn('power_usages', 'units_used')) {
                $table->renameColumn('units_used', 'units_consumed');
            }
            
            // Add meter_reading
            $table->decimal('meter_reading', 15, 2)->after('id')->nullable();
            
            // Add billing_month
            $table->string('billing_month')->after('bill_amount')->nullable();
            
            // Add payment_status
            $table->enum('payment_status', ['paid', 'pending', 'overdue'])->default('pending')->after('billing_month');
            
            // Drop old month/year if they exist
            if (Schema::hasColumn('power_usages', 'month')) {
                $table->dropColumn('month');
            }
            if (Schema::hasColumn('power_usages', 'year')) {
                $table->dropColumn('year');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('power_usages', function (Blueprint $table) {
            if (Schema::hasColumn('power_usages', 'units_consumed')) {
                $table->renameColumn('units_consumed', 'units_used');
            }
            $table->dropColumn(['meter_reading', 'billing_month', 'payment_status']);
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
        });
    }
};

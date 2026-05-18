<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Notifications\SystemNotification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users (or just one for testing)
        $users = User::all();

        foreach ($users as $user) {
            // Electricity Allocation Notification
            $user->notify(new SystemNotification(
                'New electricity schedule allocated',
                'Your farming zone has been allocated a new power schedule for tomorrow from 10:00 AM to 02:00 PM.',
                'allocation'
            ));

            // Password/Security Notification
            $user->notify(new SystemNotification(
                'New login detected',
                'We noticed a new login from an unrecognized device (Windows, Chrome). If this was you, you can ignore this message.',
                'security'
            ));

            // Billing Notification
            $user->notify(new SystemNotification(
                'New electricity bill generated',
                'Your latest electricity bill for the month of May has been generated. Total amount: ₹450.',
                'billing'
            ));
            
            // Mark the first one as read for testing the visual difference
            $user->notifications()->first()->markAsRead();
        }
    }
}

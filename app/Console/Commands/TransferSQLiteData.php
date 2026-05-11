<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransferSQLiteData extends Command
{
    protected $signature = 'transfer:data';
    protected $description = 'Transfer SQLite data to Railway MySQL';

    public function handle()
    {
        $tables = [
            'users',
            'farmers',
            'electricity_schedules',
            'power_usages',
            'complaints'
        ];

        foreach ($tables as $table) {

            $rows = DB::connection('sqlite_local')
                ->table($table)
                ->get();

            foreach ($rows as $row) {
                $targetConnection = ($table === 'power_usages') ? 'mongodb' : 'mysql';

                DB::connection($targetConnection)
                    ->table($table)
                    ->insert((array) $row);
            }

            $this->info("Transferred: $table");
        }

        $this->info('All data transferred successfully!');
    }
}
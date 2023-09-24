<?php

namespace App\Console\Commands;

use App\Models\Autofunc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process data every ten minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = '/path/to/your/sql/file.sql';

// Get the SQL file content
        $sql = file_get_contents($filePath);

// Run the SQL queries
        DB::connection()->getPdo()->exec($sql);
    }
}

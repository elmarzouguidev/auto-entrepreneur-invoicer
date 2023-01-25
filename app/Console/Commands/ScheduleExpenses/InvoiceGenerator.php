<?php

declare(strict_types=1);

namespace App\Console\Commands\ScheduleExpenses;

use Illuminate\Console\Command;

class InvoiceGenerator extends Command
{
    /**
     * @var string
     */
    protected $signature = 'expenses:run';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        return Command::SUCCESS;
    }
}

<?php

declare(strict_types=1);

namespace App\Jobs\Backup;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class CreateBackupJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    /**
     * @return void
     */
    protected $option;

    public function __construct($option = '')
    {
        $this->option = $option;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $backupJob = BackupJobFactory::createFromArray(config('backup'));

        if ($this->option === 'only-db') {
            $backupJob->dontBackupFilesystem();
        }

        if ($this->option === 'only-files') {
            $backupJob->dontBackupDatabases();
        }

        if (! empty($this->option)) {
            $prefix = str_replace('_', '-', $this->option).'-';

            $backupJob->setFilename($prefix.date('m-d-Y-H-i-s').'.zip');
        }

        $backupJob->run();
    }
}

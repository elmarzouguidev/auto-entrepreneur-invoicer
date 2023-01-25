<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        switch ($this->app->make('config')->get('backup-provider.provider')) {
            case 'google':

                $this->app->register(GoogleDriveServiceProvider::class);

                break;

            case 'dropbox':

                $this->app->register(DropboxServiceProvider::class);

                break;
            default:
                throw new \Exception('Unknown backup provider type ');
        }
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }
}

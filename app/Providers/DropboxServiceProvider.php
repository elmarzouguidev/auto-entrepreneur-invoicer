<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Storage::extend('dropbox', function ($app, $config) {
            $client = new DropBoxClient(
                $config['authorization_token']
            );

            return  new Filesystem(new DropboxAdapter($client));
        });
    }
}

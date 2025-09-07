<?php

namespace App\Support\Composer;

class LocalScripts
{
    public static function postUpdate(): void
    {
        $env = strtolower((string) getenv('APP_ENV'));
        if ($env !== 'local') {
            echo "Skipping local-only scripts (APP_ENV={$env}).\n";
            return;
        }

        self::run('php artisan ide-helper:generate');
        self::run('php artisan ide-helper:models -RW');
        self::run('php artisan ide-helper:meta');
    }

    private static function run(string $cmd): void
    {
        echo "Running: {$cmd}\n";
        passthru($cmd, $exitCode);
        if ($exitCode !== 0) {
            throw new \RuntimeException("Command failed: {$cmd}");
        }
    }
}

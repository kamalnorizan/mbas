<?php

namespace App\Listeners;

use App\Models\BackupLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Backup\Events\BackupWasSuccessful;

class LogBackupPath
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BackupWasSuccessful $event): void
    {
        Log::info('BackupWasSuccessful event triggered');
        $backupPath = $event->backupDestination->newestBackup()->path();
        Log::info('Backup Path: ' . $backupPath);
        BackupLog::create([
            'path' => $backupPath,
        ]);
    }
}

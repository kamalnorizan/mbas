<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class GenerateDefaultImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'defaultimages:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy default images to storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $source  = public_path('/falcon/assets/img/team/avatar.png');
        $destination = storage_path('app/public/profile/personal/avatar.png');
        $source2  = public_path('/falcon/assets/img/generic/4.jpg');
        $destination2 = storage_path('app/public/profile/cover/cover.jpg');

        if (!File::exists($source)) {
            return "Source file does not exist!";
        }

        if (!File::exists($source2)) {
            return "Source file does not exist!";
        }

        $destinationDir = dirname($destination);
        if (!File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        $destinationDir2 = dirname($destination2);
        if (!File::exists($destinationDir2)) {
            File::makeDirectory($destinationDir2, 0755, true);
        }

        File::copy($source, $destination);
        File::copy($source2, $destination2);

        return "Files copied successfully!";

    }
}

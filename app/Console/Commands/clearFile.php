<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class clearFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory  = public_path('/storage');
        $files = File::allFiles(($directory));
        foreach ($files as $fileObj) {
            $created = $fileObj->getMTime();
            if (time() - $created > 0.5 * 60 * 60) {
                File::delete($fileObj->getPathname());
            }
        }
    }
}

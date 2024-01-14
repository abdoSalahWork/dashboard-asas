<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyFolder extends Command
{
    protected $signature = 'copy:folder {source} {destination}';
    protected $description = 'Copy a folder from one location to another';

    public function handle()
    {
        $source = $this->argument('source');
        $destination = $this->argument('destination');

        if (File::isDirectory($source)) {
            File::copyDirectory($source, $destination);
            $this->info("Folder copied successfully!");
        } else {
            $this->error("Source folder does not exist!");
        }
    }
}

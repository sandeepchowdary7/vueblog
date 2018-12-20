<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanUpRunnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:clean-up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the clean up command that have not run - only for Data changes';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::__construct();
        $filesRun = \DB::table('__clean_ups')->lists('name');
        $files = scandir(\app_path() . '/database/clean-up');
        $filesToRun = array_filter($files, function($file) use ($filesRun) {
            if ($file[0] == '.' || substr($file, -4) != '.php' || \in_array($file, $filesRun)) {
                return false;
            }
            return true;
        });

        foreach ($filesToRun as $file) {
            $className = \studly_case(\substr($file, 18, -4)) . 'CleanUp';
            $class = new $className;
            $class->run();

            \DB::table('__clean_ups')->insert([ 'name' => $file ]);
            $this->info('Completed running ' . $file);
        }
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [];
    }
}

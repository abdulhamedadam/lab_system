<?php

namespace App\Console\Commands;

use App\Models\Admin\Test;
use Illuminate\Console\Command;

class UpdateTestsField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:update-code';

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
        $tests = Test::all();

        foreach ($tests as $test) {
            $test->test_code_st = get_app_config_data('soil_prefix') . $test->test_code;
            $test->save();
        }

        $this->info("Test codes updated successfully!");
    }
}

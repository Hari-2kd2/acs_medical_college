<?php

namespace App\Console\Commands;
use Illuminate\Http\Request;

use Illuminate\Console\Command;

class callRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:call {--uri=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artsian route:call /route';

    /*
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $request = Request::create($this->option('uri'), 'GET');
        $this->info(app()->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request));
    }
}
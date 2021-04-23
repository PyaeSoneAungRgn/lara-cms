<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupProgram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:program';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Program';

    /**
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
        $this->info('Running migrate:fresh');
        Artisan::call('migrate:fresh');
        $this->newLine();

        $this->info('Running db:seed');
        Artisan::call('db:seed');
        $this->newLine();

        $this->info('Creating admin account');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $this->table(['name', 'email', 'password'], [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123'
            ]
        ]);
        $this->newLine();
    }
}

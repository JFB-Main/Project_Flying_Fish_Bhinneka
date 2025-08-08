<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteExpiredImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-expired-images {user}';

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
        $user = $this->argument('user');

        // In a real application, you would fetch the user from the database
        // and send an actual email using Laravel's Mail facade.
        $this->info("Sending welcome email to: {$user}!");

        // Example of outputting different types of messages
        // $this->error('Something went wrong!');
        // $this->warn('This is a warning.');
        // $this->comment('This is a comment.');

    }
}

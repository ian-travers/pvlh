<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    protected $signature = 'user:verify {email}';
    protected $description = 'Verify a user\'s email address';

    public function handle()
    {
        $email = $this->argument('email');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);

            return false;
        }

        try {
            $user->markEmailAsVerified();
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return false;
        }

        $this->info('User\'s email address has been verified');

        return true;
    }
}

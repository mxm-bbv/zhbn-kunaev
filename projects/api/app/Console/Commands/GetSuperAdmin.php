<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GetSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get `Super Admin` role to developer user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /** @var User $user */
        $user = User::find(1);

        $user->assignRole('Super Admin');
    }
}

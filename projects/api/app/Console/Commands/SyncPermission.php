<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lp:sync-permission';

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
        /** @var Permission $permissions */
        $permissions = resolve(name: Permission::class);

        $permissions->syncPermissions([
            'huy',
            'pezda',
            'это долбаёбство, я парсил с команды по моделям'
        ]);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:ls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all, if any, admin accounts currently registered.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "\n{ Laravel | FPR | Van as Bloeman |\n";
        echo "|_ Admin\n    \_List\n";

        $adminList = User::all()->where('role', 'admin');
        $empty = true;

        $i = 1;
        foreach ($adminList as $adminUser)
        {
                $empty = false;
                echo "\n[Admin $i] |";
                echo "\n    [ID: $adminUser->id]";
                echo "\n    [Name: $adminUser->name]";
                echo "\n    [Email: $adminUser->email]";
                echo "\n    [Role: $adminUser->role]";
                echo "\n    [Created At: $adminUser->created_at]";
                echo "\n|\n";
                $i += 1;
        }
        if ($empty)
        {
            echo "   \nERROR | No admin accounts available to be listed. | ERROR\n";
        }
        echo"\n}";
    }
}

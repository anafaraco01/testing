<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RemoveAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:remove {UserEmail?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the admin account associated to the provided email. If no email is provided, remove all user accounts that have admin permissions.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "\n{ Laravel | FPR | Van as Bloeman |\n";
        echo "|_ Admins\n    \_Remove\n";

        $userEmail = $this->argument('UserEmail');
        $existingUser = User::where('role', 'admin')->first();

        if ($userEmail && filter_var($userEmail, FILTER_VALIDATE_EMAIL))
        {
            $userFromEmail = User::where([['email', $userEmail], ['role', 'admin']])->first();

            if ($userFromEmail)
            {
                echo "\nAccount: $userEmail | is being deleted\n";
                User::where('email', $userEmail)->first()->delete();
                echo"   \n| Admin accounts deleted successfully\n";
            } else echo "   \nERROR | No admin account uses that email: $userEmail | ERROR\n";
        } elseif ($existingUser)
        {
            function deleteUser($user): void
            {
                echo "\nAccount: $user->email | is being deleted\n";
                $user->delete();
                $existingUser = User::where('role', 'admin')->first();
                if ($existingUser) {
                    deleteUser($existingUser);
                }
            }
            deleteUser($existingUser);

            echo"   \n| Admin accounts were deleted successfully.\n";

        } else echo "   \nERROR | No admin account exists. | ERROR\n";
        echo"\n}";
    }
}

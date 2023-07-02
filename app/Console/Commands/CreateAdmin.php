<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {UserEmail=default@example.com} {UserPassword=123456}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an admin account based on the passed unique email, or name, and password. If left blank, it will make a default admin account.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "\n{ Laravel | FPR | Van as Bloeman |\n";
        echo "|_ Admin\n    \_Create\n";
        $userEmail = $this->argument('UserEmail');
        $userPassword = $this->argument('UserPassword');

        if (preg_match("#^[a-zA-Z0-9]+$#", $userEmail)) {
            $userEmail .= '@example.com';
        }

        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $existingUser = User::where('email', $userEmail)->first();
            if (! $existingUser) {
                User::create([
                    "name" => strstr($userEmail,'@',true),
                    "email" => $userEmail,
                    "password" => Hash::make($userPassword),
                    "role" => "admin",
                    "password_changed" => 1,
                    "secret_answer1" => "Roses",
                    "secret_answer2" => "Blue",
                    "reset_password" => 0,
                ]);
                echo "  \n| Admin account created: $userEmail | $userPassword\n";
            } else echo "   \nERROR | An account already uses that email: $userEmail | ERROR\n";
        } else echo "   \nERROR | The email you entered is not in valid format: { $userEmail } - Correct format: { email@webite.com } | ERROR\n";

        echo"\n}";
    }
}

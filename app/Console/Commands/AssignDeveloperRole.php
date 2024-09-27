<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignDeveloperRole extends Command
{
    protected $signature = 'user:assign-developer {email}';
    protected $description = 'Assign developer role to a user';
    
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $user->assignRole('desarrollador');
        $this->info("Developer role assigned to user {$user->name}.");
        
    }
}

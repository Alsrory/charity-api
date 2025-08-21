<?php

namespace App\Services;

use App\Jobs\SendUserEmail;
use App\Mail\UserEmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class UserService 
{
    /**
     * Register services.
     */
   public function register(array $data)
    {
        // create user
        $user = User::create($data);
       // Assign roles: either from the request or default to 'user' role
        // If 'role_ids' is not provided, default to the 'user' role
        $user->loadMissing('roles');
        $roleIds = $data['role_ids'] ?? [Role::where('name', 'user')->value('id')];
        $user->roles()->attach($roleIds);
        // send email
         SendUserEmail::dispatch($user);
        // Optionally, you can send an email directly

        return $user;
    }
    // Update user data
    public function update(User $user, array $data)
    {
        $user->update($data);
         $user->loadMissing('roles');
        // If roles are provided, update them
        if (isset($data['role_ids'])) {
            $user->roles()->sync($data['role_ids']);
        }

         Mail::to($user->email)->send(new UserEmail($user));
        return $user;
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

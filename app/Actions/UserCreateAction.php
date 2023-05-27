<?php

namespace App\Actions;

use App\Jobs\CreateSmoiceCustomer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreateAction
{
    public function __invoke($attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        $user = User::create($attributes);
        // CreateSmoiceCustomer::dispatch($user);
        if(request('permissions')){
            $user->syncPermissions(request('permissions'));
        }
        return true;
    }
}
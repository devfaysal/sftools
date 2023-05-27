<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserUpdateAction
{
    public function __invoke(User $user, $attributes)
    {
        if($attributes['password']){
            $attributes['password'] = Hash::make($attributes['password']);
        }
        if(empty($attributes['password'])){
            unset($attributes['password']);
        }
        $user->update($attributes);

        if(request('permissions')){
            $user->syncPermissions(request('permissions'));
        }

        return true;
    }
}
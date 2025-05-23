<?php

namespace Modules\User\Repositories\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\User\Entities\Client;

class ClientRepository
{
    public function updateProfile(Request $request)
    {
        $user = auth('client')->user();

        try{
            $user->update([
                'password' => $request->password ?  Hash::make($request->password) : $user->password,
                'user_name' => $request->user_name ?? $user->user_name,
            ]);

            return true;
        }catch (\Exception $e){

        }
    }
}

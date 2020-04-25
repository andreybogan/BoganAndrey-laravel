<?php

namespace App\Adaptor;

use App\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

class Adaptor
{
    public function getUserBySocId(UserOAuth $user, string $socName)
    {
        $userInSystem = User::query()
            ->where('id_in_soc', $user->id)
            ->where('type_auth', $socName)
            ->first();
        if (is_null($userInSystem)) {
            $userInSystem = new User();
            $userInSystem->fill([
                'name' => !empty($user->getName()) ? $user->getName() : '',
            ]);
        }
    }
}

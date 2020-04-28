<?php

namespace App\Adaptor;

use App\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;

/**
 * Class Adaptor
 * @package App\Adaptor
 */
class Adaptor
{
    /**
     * Получаем пользователя по ID социальной сети.
     * @param UserOAuth $user
     * @param string $socName
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getUserBySocId(UserOAuth $user, string $socName)
    {
        // Получаем пользователя из базы данных.
        $userInSystem = User::query()
            ->where('id_in_soc', $user->id)
            ->where('type_auth', $socName)
            ->first();

        // Если пользователь не существует, то создаем нового пользователя и сохраняем его в базе.
        if (is_null($userInSystem)) {
            $userInSystem = new User();
            $userInSystem->fill([
                'name' => !empty($user->getName()) ? $user->getName() : '',
                'email' => $user->accessTokenResponseBody['email'],
                'password' => '',
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '',
                'type_auth' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : '',
            ]);

            $userInSystem->save();
        }

        return $userInSystem;
    }
}

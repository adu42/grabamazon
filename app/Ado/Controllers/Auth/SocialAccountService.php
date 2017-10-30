<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2016/3/11
 * Time: 9:17
 */

namespace App\Ado\Controllers\Auth;

use Laravel\Socialite\Contracts\Provider;
use App\Ado\Models\Tables\User\User;
use App\Ado\Models\Oauth\SocialAccount;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        $result = true;
        try {
            $providerUser = $provider->user();
        } catch (InvalidStateException $e) {
            $result = false;
        }
        if ($result) {
            $providerName = class_basename($provider);
            $account = SocialAccount::whereProvider($providerName)
                ->whereProviderUserId($providerUser->getId())
                ->first();

            if ($account):
                return $account->user;
            else :
                $account = new SocialAccount([
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => $providerName
                ]);

                $user = User::whereEmail($providerUser->getEmail())->first();

                if (!$user):
                    $user = User::create([
                        'email' => $providerUser->getEmail(),
                        'name' => $providerUser->getName(),
                    ]);
                endif;

                $account->user()->associate($user);
                $account->save();

                return $user;

            endif;
        }
        return false;
    }
}
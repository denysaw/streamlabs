<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class OAuthController extends Controller
{


    /**
     * Redirect user to a Provider auth page
     *
     * @param $provider
     * @return RedirectResponse
     */
    public function redirectToProvider($provider): RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Receive user information from a Provider
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider): JsonResponse
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 406);
        }

        $user = User::firstOrCreate(
            [
                'email' => $providerUser->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $providerUser->getName()
            ]
        );

        $user->oauth_providers()->updateOrCreate(
            [
                'name' => $provider,
                'user_id' => $user->id,
            ],
            [
                'provider_user_id' => $providerUser->getId(),
                'avatar' => $providerUser->getAvatar()
            ]
        );

        $token = $user->createToken('Streamlabs')->plainTextToken;
        return response()->json($user, 200, ['Access-Token' => $token]);
    }
}

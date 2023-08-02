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
     * Returns Provider auth page url
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider): JsonResponse
    {
        return response()->json(['url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl()]);
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

        $user->token = $user->createToken('Streamlabs')->plainTextToken;
        return response()->json($user);
    }
}

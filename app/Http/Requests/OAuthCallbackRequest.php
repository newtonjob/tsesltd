<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;

class OAuthCallbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a passed validation attempt.
     */
    public function fulfill(): User
    {
        $socialiteUser = Socialite::with($this->provider)->user();

        $user = $this->getLocalUser($socialiteUser);

        $user->email_verified_at ??= now();

        /*if ($user->doesntHavePhoto()) {
            $user->photo = $socialiteUser->getAvatar(); // Todo: Upload to cloudinary and save path.
        }*/

        return tap($user)->save();
    }

    /**
     * Get the existing local user or create a new user.
     */
    public function getLocalUser(SocialiteUser $socialiteUser): User
    {
        return User::whereEmail($socialiteUser->getEmail())->firstOr(
            fn () => User::make([
                'email'      => $socialiteUser->getEmail(),
                'first_name' => $socialiteUser->getName(),
            ])
        );
    }
}

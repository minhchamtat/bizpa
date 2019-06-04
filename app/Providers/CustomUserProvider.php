<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Http\Request;

class CustomUserProvider extends EloquentUserProvider {

    /**
    * Validate a user against the given credentials.
    *
    * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    * @param  array  $credentials
    * @return bool
    */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password']; // will depend on the name of the input on the login form
        $hashedValue = $user->getAuthPassword();
        $iterations = 10;
        $password = hash_pbkdf2("sha256", $plain, $user->password_salt, $iterations, 20);

        if ($password == $user->getAuthPassword()) {
            return true;
        } else return false;
    }

}
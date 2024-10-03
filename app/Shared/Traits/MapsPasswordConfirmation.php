<?php

namespace App\Shared\Traits;

trait MapsPasswordConfirmation
{
    protected function mapPasswordConfirmation(array $credentials)
    {
        $credentials['password_confirmation'] = $credentials['passwordConfirmation'];
        unset($credentials['passwordConfirmation']);
        return $credentials;
    }
}

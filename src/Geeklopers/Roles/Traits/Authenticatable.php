<?php

namespace Geeklopers\Roles\Traits;

use Illuminate\Auth\Authenticatable as AuthenticatableLaravel;

trait Authenticatable
{
    use AuthenticatableLaravel;

    
    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    public function getAuthPassword() {
        return $this->vc_password;
    }
}

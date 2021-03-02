<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

trait WithUser
{
    /**
     * User
     *
     * @var User|Authenticatable
     */
    protected $user;

    /**
     * Get User
     *
     * @return User|Authenticatable
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param User|Authenticatable $user User
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}

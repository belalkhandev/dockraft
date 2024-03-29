<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return User::class;
    }
}

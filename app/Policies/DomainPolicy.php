<?php

namespace App\Policies;

use App\Models\Extension;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DomainPolicy
{

    public function viewAny(User $user)
    {
        return $user->can('view domains');

    }


    public function view(User $user, Extension $domain): bool
    {
        return $user->can('view private extension');
    }

    public function create(User $user): bool
    {
        return true;
    }


    public function update(User $user, Extension $domain): bool
    {
        return true;
    }


    public function delete(User $user, Extension $domain): bool
    {

        return true;
    }


    public function restore(User $user, Extension $domain): bool
    {
        return true;
    }


    public function forceDelete(User $user, Extension $domain): bool
    {
        return true;
    }
}

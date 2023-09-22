<?php

namespace App\Policies;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DomainPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }


    public function view(User $user, Domain $domain): bool
    {
        // A FAIRE
        return true;
    }


    public function create(User $user): bool
    {
        return true;
    }


    public function update(User $user, Domain $domain): bool
    {
        return true;
    }


    public function delete(User $user, Domain $domain): bool
    {
        return true;
    }


    public function restore(User $user, Domain $domain): bool
    {
        return true;
    }


    public function forceDelete(User $user, Domain $domain): bool
    {
        return true;
    }
}

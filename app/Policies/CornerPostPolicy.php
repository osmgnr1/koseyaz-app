<?php

namespace App\Policies;

use App\Models\CornerPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CornerPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CornerPost $cornerPost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */

     public function update_view(User $user, $cornerPost): bool|Response|RedirectResponse
     {
        return $user->id === $cornerPost->user->id ? true:Response::deny('SADECE SAHİBİ OLUNAN KÖŞE YAZILARI GÜNCELLENEBİLİR...');
     }

    public function update(User $user, CornerPost $cornerPost): bool
    {
        return $user->id === $cornerPost->user_id ? true:Response::deny('SADECE SAHİBİ OLUNAN KÖŞE YAZILARI GÜNCELLENEBİLİR...');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CornerPost $cornerPost): bool
    {
        return $user->id === $cornerPost->user_id ? true:Response::deny('SADECE SAHİBİ OLUNAN KÖŞE YAZILARI SİLİNEBİLİR...');;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CornerPost $cornerPost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CornerPost $cornerPost): bool
    {
        return false;
    }
}

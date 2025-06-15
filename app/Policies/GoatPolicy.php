<?php

namespace App\Policies;

use App\Models\Goat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoatPolicy
{
    use HandlesAuthorization;

    /**
     * Allow admin to perform any action.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') { // Asumsi Anda punya kolom 'role' di tabel users
            return true;
        }
        return null; // Continue to other checks if not admin
    }

    /**
     * Determine whether the user can view any models.
     * (ListGoats sudah dihandle di getTableQuery, ini bisa untuk akses API misalnya)
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua user yang login bisa lihat daftar (yang sudah difilter)
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Goat $goat): bool
    {
        // User hanya bisa lihat detail kambing miliknya
        return $user->id === $goat->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Semua user yang login (bukan guest) bisa mencoba membuat data kambing
        // Logika kepemilikan farm bisa dihandle saat mutateFormDataBeforeCreate
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Goat $goat): bool
    {
        // User hanya bisa update kambing miliknya
        return $user->id === $goat->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Goat $goat): bool
    {
        // User hanya bisa delete kambing miliknya
        return $user->id === $goat->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Goat $goat): bool
    {
        return $user->id === $goat->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Goat $goat): bool
    {
        return $user->id === $goat->user_id;
    }
}
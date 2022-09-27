<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductCategorie;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoriePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_product::categorie');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('view_product::categorie');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_product::categorie');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('update_product::categorie');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('delete_product::categorie');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_product::categorie');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('force_delete_product::categorie');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_product::categorie');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('restore_product::categorie');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_product::categorie');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategorie  $productCategorie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, ProductCategorie $productCategorie)
    {
        return $user->can('replicate_product::categorie');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_product::categorie');
    }

}

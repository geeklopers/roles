<?php

namespace Geeklopers\Roles\Traits;

use Illuminate\Database\Eloquent\Model;

trait RolesRelaciones
{
    /**
     * Roles pertenecen a muchos permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos()
    {
        return $this->belongsToMany(config('roles.models.permisos'))->withTimestamps();
    }

    /**
     * Roles pertenecen a muchos usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios()
    {
        return $this->belongsToMany(config('roles.models.usuarios'))->withTimestamps();
    }

    /**
     * Attach permiso a un rol.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int|bool
     */
    public function attachPermiso( Model $permiso )
    {
        return (!$this->permisos()->get()->contains($permiso)) ? $this->permisos()->attach($permiso) : true;
    }

    /**
     * Detach permiso de un rol.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int
     */
    public function detachPermiso( Model $permiso )
    {
        return $this->permisos()->detach($permiso);
    }

    /**
     * Detach todos los permisos.
     *
     * @return int
     */
    public function detachAllPermisos()
    {
        return $this->permisos()->detach();
    }
}

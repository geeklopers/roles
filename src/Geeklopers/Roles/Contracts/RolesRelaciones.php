<?php

namespace Geeklopers\Roles\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RolesRelaciones
{
    /**
     * Roles pertenecen a muchos permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos();

    /**
     * Roles pertenecen a muchos usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios();

    /**
     * Attach permiso a un rol.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int|bool
     */
    public function attachPermiso( Model $permiso );

    /**
     * Detach permiso de un rol.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int
     */
    public function detachPermiso( Model $permiso );

    /**
     * Detach todos los permisos.
     *
     * @return int
     */
    public function detachAllPermisos();
}

<?php

namespace Geeklopers\Roles\Contracts;

interface PermisosRelaciones
{
    /**
     * Permiso pertenece a muchos roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * Permiso pertenece a muchos usuarios
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios();

    /**
     * Permiso pertenece a un modulo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo();
}

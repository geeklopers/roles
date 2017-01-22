<?php

namespace Geeklopers\Roles\Traits;

trait PermisosRelaciones
{
    /**
     * Permisos pertenece a muchos roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('roles.models.roles'), 'roles_permisos', 'id_rol', 'id_permiso')->withTimestamps();
    }

    /**
     * Permisos pertenecen a muchos usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usuarios()
    {
        return $this->belongsToMany(config('roles.models.usuarios'))->withTimestamps();
    }

    /**
     * Permiso pertenece a un modulo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo()
    {
        return $this->belongsTo(config('roles.models.modulos'))->withTimestamps();
    }
}

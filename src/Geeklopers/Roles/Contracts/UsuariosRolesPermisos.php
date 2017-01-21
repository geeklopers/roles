<?php

namespace Geeklopers\Roles\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UsuariosRolesPermisos
{
    /**
     * Usuarios pertenece a muchos roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * User belongs to many permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos();

    /**
     * Obtener todos los roles del usuario.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoles();

    /**
     * Guardar rol al usuario.
     *
     * @param \Illuminate\Database\Eloquent\Model $rol
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setRol( Model $rol );

    /**
     * Obtener todos los roles del usuario.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRol();

    /**
     * Get all permisos as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermisos();

    /**
     * Obtener el nivel del usuario
     *
     * @return int
     */
    public function nivel();

    /**
     * Get all permisos from roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRolPermisos();

    /**
     * Check if the user has role.
     *
     * @param int|string $rol
     * @return bool
     */
    public function hasRol( $rol );

    /**
     * Check if the user has a permiso.
     *
     * @param int|string $permiso
     * @param bool $rol
     * @return bool
     */
    public function hasPermiso( $permiso, $rol = false );

    /**
     * Validar si usurio tiene un rol.
     *
     * @param int|string|array $rol
     * @param bool $all
     * @return bool
     */
    public function is($rol, $all = false);

    /**
     * Check if the user has at least one role.
     *
     * @param int|string|array $rol
     * @return bool
     */
    public function isOne($rol);

    /**
     * Check if the user has all roles.
     *
     * @param int|string|array $rol
     * @return bool
     */
    public function isAll($rol);
    
    /**
     * Check if the user has a permiso or permisos.
     *
     * @param int|string|array $permiso
     * @param bool $all
     * @return bool
     */
    public function can($permiso, $all = false);

    /**
     * Check if the user has at least one permiso.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canOne($permiso);

    /**
     * Check if the user has all permisos.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canAll($permiso);

    /**
     * Attach role to a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return null|bool
     */
    public function attachRole( Model $rol );

    /**
     * Detach role from a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return int
     */
    public function detachRole($rol);

    /**
     * Detach all roles from a user.
     *
     * @return int
     */
    public function detachAllRoles();

    /**
     * Attach permiso to a user.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return null|bool
     */
    public function attachPermiso( Model $permiso );

    /**
     * Detach permiso del usuario.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int
     */
    public function detachPermiso( Model $permiso );

    /**
     * Detach all permisos from a user.
     *
     * @return int
     */
    public function detachAllPermisos();

    /**
     * Check if the user is allowed to manipulate with entity.
     *
     * @param string $providedPermiso
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @param bool $owner
     * @param string $ownerColumn
     * @return bool
     */
    public function allowed($providedPermiso, Model $entity, $owner = true, $ownerColumn = 'user_id');

    /**
     * Check if the user is allowed to manipulate with provided entity.
     *
     * @param string $providedPermiso
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @return bool
     */
    protected function isAllowed($providedPermiso, Model $entity);
}

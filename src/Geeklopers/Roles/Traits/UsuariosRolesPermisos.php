<?php

namespace Geeklopers\Roles\Traits;

use Illuminate\Database\Eloquent\Model;

trait UsuariosRolesPermisos
{
	/**
     * Propiedad para guardar el rol.
     *
     * @var \Illuminate\Database\Eloquent\Model|null
     */
    protected $rol;

    /**
     * Propiedad para guardar los roles.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $roles;


    /**
     * Propiedad para guardar los permisos.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $permisos;


    /**
     * Usuarios pertenece a muchos roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
    {
        return $this->belongsToMany(config('roles.models.roles'))->withTimestamps();
    } 

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
    {
        return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
    }

    /**
     * Get all permisos as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermisos();
    {
        return (!$this->permisos) ? $this->permisos = $this->userpermisos()->get() : $this->permisos;
    }

    /**
     * Check if the user has role.
     *
     * @param int|string $role
     * @return bool
     */
    public function hasRole($role);

    /**
     * Check if the user has a permiso.
     *
     * @param int|string $permiso
     * @return bool
     */
    public function hasPermiso($permiso);

    /**
     * Obtener el nivel del usuario
     *
     * @return int
     */
    public function getNivel();
    {
    	return ( !!$this->rol ) ? $this->rol->nu_nivel : 0;
    }

    /**
     * Get all permisos from roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function rolPermisos();

    /**
     * Validar si usurio tiene un rol.
     *
     * @param int|string|array $role
     * @param bool $all
     * @return bool
     */
    public function is($role, $all = false);

    /**
     * Check if the user has all roles.
     *
     * @param int|string|array $role
     * @return bool
     */
    public function isAll($role);

    /**
     * Check if the user has at least one role.
     *
     * @param int|string|array $role
     * @return bool
     */
    public function isOne($role);

    
    /**
     * Check if the user has a permiso or permisos.
     *
     * @param int|string|array $permiso
     * @param bool $all
     * @return bool
     */
    public function can($permiso, $all = false);

    /**
     * Check if the user has all permisos.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canAll($permiso);

    /**
     * Check if the user has at least one permiso.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canOne($permiso);

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
     * Attach role to a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return null|bool
     */
    public function attachRole( Model $rol );
    {
        return (!$this->getRoles()->contains($rol)) ? $this->roles()->attach($rol) : true;
    }

    /**
     * Detach role from a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return int
     */
    public function detachRole($rol);
    {
        $this->roles = null;

        return $this->roles()->detach($role);
    }

    /**
     * Detach all roles from a user.
     *
     * @return int
     */
    public function detachAllRoles();
    {
        $this->roles = null;
        $this->rol = null;

        return $this->roles()->detach();
    }

    /**
     * Attach permiso to a user.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return null|bool
     */
    public function attachPermiso( Model $permiso );
    {
        return (!$this->permisos()->contains( $permiso )) ? $this->permisos()->attach($permiso) : true;
    }

    /**
     * Detach permiso del usuario.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int
     */
    public function detachPermiso( Model $permiso );
    {
        $this->permisos = null;

        return $this->permisos()->detach($permiso);
    }

    /**
     * Detach all permisos from a user.
     *
     * @return int
     */
    public function detachAllPermisos();
    {
        $this->permisos = null;
        
        return $this->permisos()->detach();
    }

}

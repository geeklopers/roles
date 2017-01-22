<?php

namespace Geeklopers\Roles\Traits;

use Illuminate\Support\Str;
use InvalidArgumentException;
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
    public function roles()
    {
        return $this->belongsToMany(config('roles.models.roles'), 'usuarios_roles', 'id_usuario', 'id_rol')->withTimestamps();
    } 

    /**
     * User belongs to many permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos()
    {
        return $this->belongsToMany(config('roles.models.permisos'), 'usuarios_permisos', 'id_usuario', 'id_permiso')->withTimestamps();
    }

    /**
     * Obtener todos los roles del usuario.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoles()
    {
        return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
    }

    /**
     * Guardar rol al usuario.
     *
     * @param \Illuminate\Database\Eloquent\Model $rol
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setRol( Model $rol )
    {
        if( !$this->hasRol( $rol->id ) )
            throw new InvalidArgumentException("El usuario no cuenta con ese rol");

        $this->rol = $rol;

        return $this;
    }

    /**
     * Obtener todos los roles del usuario.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRol()
    {
        return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
    }

    /**
     * Get all permisos as collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermisos()
    {
        return (!$this->permisos) ? $this->permisos = $this->permisos()->get() : $this->permisos;
    }

    /**
     * Obtener el nivel del usuario
     *
     * @return int
     */
    public function nivel()
    {
        return ( !!$this->rol ) ? $this->rol->nu_nivel : 0;
    }

    /**
     * Get all permisos from roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRolPermisos()
    {
        if ( !$this->rol ) 
        {
            throw new InvalidArgumentException('El usuario debe tener seleccionado un rol');
        }

        return $this->permisos()->where('id_rol', $this->rol->id )->get();
    }

    /**
     * Check if the user has role.
     *
     * @param int|string $rol
     * @param bool $actual
     * @return bool
     */
    public function hasRol( $rol, $actual = false )
    {
        if( $actual && !!$this->rol )
            return $rol == $this->rol->id || Str::is($rol, $this->rol->vc_slug);

        return $this->getRoles()->contains(function ($key, $value) use ($rol) {
            return $rol == $value->id || Str::is($rol, $value->vc_slug);
        });
    }

    /**
     * Check if the user has a permiso.
     *
     * @param int|string $permiso
     * @param bool $rol
     * @return bool
     */
    public function hasPermiso( $permiso, $rol = false )
    {
        $permisos = $rol ? $this->getRolPermisos() : $this->getPermisos();

        return $permisos->contains(function ($key, $value) use ($permiso) {
            return $permiso == $value->id || Str::is($permiso, $value->vc_slug);
        });
    }

    /**
     * Validar si usurio tiene un rol.
     *
     * @param int|string|array $rol
     * @param bool $all
     * @return bool
     */
    public function is($rol, $all = false)
    {
        if ($this->isPretendEnabled()) {
            return $this->pretend('is');
        }

        return $this->{$this->getMethodName('is', $all)}($rol);
    }

    /**
     * Check if the user has at least one role.
     *
     * @param int|string|array $rol
     * @return bool
     */
    public function isOne($rol)
    {
        foreach ($this->getArrayFrom($rol) as $rol) {
            if ( $this->hasRol( $rol, true ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has all roles.
     *
     * @param int|string|array $rol
     * @return bool
     */
    public function isAll($rol)
    {
        foreach ($this->getArrayFrom($rol) as $rol) {
            if ( !$this->hasRol( $rol, true ) ) {
                return false;
            }
        }

        return true;
    }
    
    /**
     * Check if the user has a permiso or permisos.
     *
     * @param int|string|array $permiso
     * @param bool $all
     * @return bool
     */
    public function can($permiso, $all = false)
    {
        if ($this->isPretendEnabled()) {
            return $this->pretend('can');
        }

        return $this->{$this->getMethodName('can', $all)}($permiso);
    }

    /**
     * Check if the user has at least one permiso.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canOne($permiso)
    {
        foreach ($this->getArrayFrom($permiso) as $permiso) {
            if ($this->hasPermiso($permiso, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has all permisos.
     *
     * @param int|string|array $permiso
     * @return bool
     */
    public function canAll($permiso)
    {
        foreach ($this->getArrayFrom($permiso) as $permiso) {
            if (!$this->hasPermiso($permiso, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Attach role to a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return null|bool
     */
    public function attachRol( Model $rol )
    {
        return (!$this->getRoles()->contains($rol)) ? $this->roles()->attach($rol) : true;
    }

    /**
     * Detach role from a user.
     *
     * @param int|\Geeklopers\Roles\Models\Roles $rol
     * @return int
     */
    public function detachRol($rol)
    {
        $this->roles = null;

        return $this->roles()->detach($rol);
    }

    /**
     * Detach all roles from a user.
     *
     * @return int
     */
    public function detachAllRoles()
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
    public function attachPermiso( Model $permiso )
    {
        return (!$this->permisos()->contains( $permiso )) ? $this->permisos()->attach($permiso) : true;
    }

    /**
     * Detach permiso del usuario.
     *
     * @param int|\Geeklopers\Roles\Models\Permisos $permiso
     * @return int
     */
    public function detachPermiso( Model $permiso )
    {
        $this->permisos = null;

        return $this->permisos()->detach($permiso);
    }

    /**
     * Detach all permisos from a user.
     *
     * @return int
     */
    public function detachAllPermisos()
    {
        $this->permisos = null;
        
        return $this->permisos()->detach();
    }

    /**
     * Check if the user is allowed to manipulate with entity.
     *
     * @param string $providedPermiso
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @param bool $owner
     * @param string $ownerColumn
     * @return bool
     */
    public function allowed($providedPermiso, Model $entity, $owner = true, $ownerColumn = 'user_id')
    {
        if ($this->isPretendEnabled()) {
            return $this->pretend('allowed');
        }

        if ($owner === true && $entity->{$ownerColumn} == $this->id) {
            return true;
        }

        return $this->isAllowed($providedPermiso, $entity);
    }

    /**
     * Check if the user is allowed to manipulate with provided entity.
     *
     * @param string $providedPermiso
     * @param \Illuminate\Database\Eloquent\Model $entity
     * @return bool
     */
    protected function isAllowed($providedPermiso, Model $entity)
    {
        foreach ($this->getPermisos() as $permiso) {
            if ($permiso->model != '' && get_class($entity) == $permiso->model
                && ($permiso->id == $providedPermiso || $permiso->vc_slug === $providedPermiso)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if pretend option is enabled.
     *
     * @return bool
     */
    private function isPretendEnabled()
    {
        return (bool) config('roles.pretend.enabled');
    }

    /**
     * Allows to pretend or simulate package behavior.
     *
     * @param string $option
     * @return bool
     */
    private function pretend($option)
    {
        return (bool) config('roles.pretend.options.' . $option);
    }

    /**
     * Get method name.
     *
     * @param string $methodName
     * @param bool $all
     * @return string
     */
    private function getMethodName($methodName, $all)
    {
        return ((bool) $all) ? $methodName . 'All' : $methodName . 'One';
    }

    /**
     * Get an array from argument.
     *
     * @param int|string|array $argument
     * @return array
     */
    private function getArrayFrom($argument)
    {
        return (!is_array($argument)) ? preg_split('/ ?[,|] ?/', $argument) : $argument;
    }

    /**
     * Handle dynamic method calls.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (starts_with($method, 'is')) {
            return $this->is(snake_case(substr($method, 2), config('roles.separator')));
        } elseif (starts_with($method, 'can')) {
            return $this->can(snake_case(substr($method, 3), config('roles.separator')));
        } elseif (starts_with($method, 'allowed')) {
            return $this->allowed(snake_case(substr($method, 7), config('roles.separator')), $parameters[0], (isset($parameters[1])) ? $parameters[1] : true, (isset($parameters[2])) ? $parameters[2] : 'user_id');
        }

        return parent::__call($method, $parameters);
    }
}

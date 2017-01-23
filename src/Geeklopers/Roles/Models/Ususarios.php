<?php

namespace Geeklopers\Roles\Models;

use Illuminate\Database\Eloquent\Model;
use Geeklopers\Roles\Traits\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Geeklopers\Roles\Traits\UsuariosRolesPermisos;
use Geeklopers\Roles\Contracts\Authenticatable as AuthenticatableContract;
use Geeklopers\Roles\Contracts\UsuariosRolesPermisos as UsuariosRolesPermisosContract;

class Usuarios extends Model implements UsuariosRolesPermisosContract, AuthenticatableContract
{
    use UsuariosRolesPermisos, Authenticatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'usuarios';
    protected $fillable = ['vc_nombre', 'vc_email', 'vc_password'];

}
 
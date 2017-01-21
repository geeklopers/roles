<?php

namespace Geeklopers\Roles\Models;

use Illuminate\Database\Eloquent\Model;
use Geeklopers\Roles\Traits\UsuariosRolesPermisos;
use Geeklopers\Roles\Contracts\UsuariosRolesPermisos as UsuariosRolesPermisosContract;

class Usuarios extends Model implements UsuariosRolesPermisosContract
{
    use UsuariosRolesPermisos;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'usuarios';
    protected $fillable = ['vc_nombre', 'vc_email', 'vc_password'];

}
 
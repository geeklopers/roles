<?php

namespace Geeklopers\Roles\Models;

use Geeklopers\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Geeklopers\Roles\Traits\RolesRelaciones;
use Geeklopers\Roles\Contracts\RolesRelaciones as RolesRelacionesContract;

class Roles extends Model implements RolesRelacionesContract
{
    use Slugable, RolesRelaciones;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';
    protected $fillable = ['vc_nombre', 'vc_slug', 'vc_descripcion', 'nu_nivel'];

}

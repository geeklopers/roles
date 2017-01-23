<?php

namespace Geeklopers\Roles\Models;

use Geeklopers\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Geeklopers\Roles\Traits\PermisosRelaciones;
use Geeklopers\Roles\Contracts\PermisosRelaciones as PermisosRelacionesContract;

class Permisos extends Model implements PermisosRelacionesContract
{
    use Slugable, PermisosRelaciones;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'permisos';
    protected $fillable = ['id_modelo', 'vc_nombre', 'vc_slug', 'vc_descripcion'];
}

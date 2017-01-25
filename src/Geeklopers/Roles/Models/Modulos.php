<?php

namespace Geeklopers\Roles\Models;

use Geeklopers\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    use Slugable;

    const CREATED_AT = 'dt_registro';
    const UPDATED_AT = 'dt_editado';
    const DELETED_AT = 'dt_eliminado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'modulos';
    protected $fillable = ['vc_nombre', 'vc_slug', 'vc_descripcion'];

}

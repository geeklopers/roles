<?php

namespace Geeklopers\Roles\Models;

use Geeklopers\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    use Slugable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'modulos';
    protected $fillable = ['vc_nombre', 'vc_slug', 'vc_descripcion'];

}

<?php

namespace Geeklopers\Roles\Models;

use Geeklopers\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Geeklopers\Roles\Traits\RoleHasRelations;
use Geeklopers\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;

class Usuarios extends Model implements RoleHasRelationsContract
{
    use Slugable, RoleHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

}

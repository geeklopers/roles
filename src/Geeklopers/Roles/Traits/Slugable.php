<?php

namespace Geeklopers\Roles\Traits;

use Illuminate\Support\Str;

trait Slugable
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function setVcSlugAttribute($value)
    {
        $this->attributes['vc_slug'] = Str::slug($value, config('roles.separator'));
    }
}

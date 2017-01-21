<?php

namespace Geeklopers\Roles\Contracts;

interface ModulosRelaciones
{
    /**
     * Modulo tiene muchos permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos();
}

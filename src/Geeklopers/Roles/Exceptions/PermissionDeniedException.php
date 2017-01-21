<?php

namespace Geeklopers\Roles\Exceptions;

class PermissionDeniedException extends AccessDeniedException
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $permission
     */
    public function __construct($permission)
    {
        $this->message = sprintf("El usuario ocupa el permiso ['%s'] para continuar.", $permission);
    }
}

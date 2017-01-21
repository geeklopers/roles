<?php

namespace Geeklopers\Roles\Exceptions;

class RoleDeniedException extends AccessDeniedException
{
    /**
     * Create a new role denied exception instance.
     *
     * @param string $role
     */
    public function __construct($role)
    {
        $this->message = sprintf("El usuario ocupara el rol ['%s'] para continuar.", $role);
    }
}

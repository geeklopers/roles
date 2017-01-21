<?php

namespace Geeklopers\Roles\Exceptions;

class LevelDeniedException extends AccessDeniedException
{
    /**
     * Create a new level denied exception instance.
     *
     * @param string $level
     */
    public function __construct($level)
    {
        $this->message = sprintf("El usuario ocupa un nivel [%s] para continuar.", $level);
    }
}

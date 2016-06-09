<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher;



class Env
{

    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return $_ENV[$name];
    }

}

<?php

namespace Core\Contract;

interface Provider
{
    /**
     * running the script
     * @return any
     */
    public function boot();
}

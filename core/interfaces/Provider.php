<?php

namespace Core\Interfaces;

interface Provider
{
    /**
     * running the script
     * @return any
     */
    public function boot();
}

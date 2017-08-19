<?php

namespace Core\Statics;

trait MakeStatic
{
    public static function instance()
    {
        return new static;
    }
}

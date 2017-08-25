<?php

namespace Core\Traits;

trait ValidationTrait
{
    private function unique($value, $key, $db)
    {
        $unique = count(db()->table($db)->where($key,'=',$value)->get()) > 0;
        return [ 'status' => $unique , 'value' => "Input {$key} allready exists." ];
    }

    private function string($value, $key)
    {
        return [ 'status' => !is_string($value) , 'value' => "Input {$key} Must Be Alphabetical" ];
    }

    private function required($value, $key)
    {
        return [ 'status' => $value == null || $value == "" , 'value' => "Input {$key} Must Be Filled"];
    }

    private function numeric($value, $key)
    {
        return [ 'status' => !is_numeric($value) , 'value' => "Input {$key} Must Be Number" ];
    }

    private function alpha($value, $key)
    {
        return [ 'status' => !ctype_alpha($value) , 'value' => "Input {$key} Must Be Alphabetical" ];
    }

    private function alphanumeric($value, $key)
    {
        return [ 'status' => !ctype_alnum($value) , 'value' => "Input {$key} Must Be Alphanumeric" ];
    }

    private function date($value, $key)
    {
        $d = \DateTime::createFromFormat('Y-m-d',$value);
        $cek = $d && $d->format('Y-m-d') == $value;
        return [ 'status' => !$cek , 'value' => "Input {$key} Must Be Date With Format YYYY-MM-DD" ];
    }
}

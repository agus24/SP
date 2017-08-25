<?php

namespace Core\Validator;

class Validator extends ValidatorService
{
    public static function instance()
    {
        return new static;
    }

    public function validate($validation,$request)
    {
        $this->validation = $validation;
        $this->request = $request->body;
        return $this->serviceRun();
    }
}

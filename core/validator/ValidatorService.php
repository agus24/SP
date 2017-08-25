<?php

namespace Core\Validator;

use Core\Session;
use Core\Traits\ValidationTrait;

class ValidatorService
{
    use ValidationTrait;
    protected $validation;
    protected $request;

    protected function serviceRun()
    {
        $error = array();
        foreach($this->validation as $key => $valids)
        {
            $valid = explode("|", $valids);
            foreach($valid as $vld)
            {
                $res = $this->$vld($this->request[$key],$key);
                if($res['status'])
                {
                    $error[$key] = $res['value'];
                }
            }
        }
        if(count($error) > 0)
        {
            Session::flash('error',$error);
            return back();
        }
    }
}

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
        $log = '';
        foreach($this->validation as $key => $valids)
        {
            if($valids != '')
            {
                $valid = explode("|", $valids);
                $totalLoop = 0;
                foreach($valid as $key2 => $vld)
                {
                    if(count(explode(":",$vld)) > 1)
                    {
                        $log.=$key2;
                        $v = explode(":",$vld);
                        $vd = $v[0];
                        $res = $this->$vd($this->request[$key], $key, $v[1]);
                    }
                    else
                    {
                        $res = $this->$vld($this->request[$key],$key);
                    }
                    if($res['status'])
                    {
                        $error[$key] = $res['value'];
                    }
                }
            }
        }

        if(count($error) > 0)
        {
            Session::flash('error',$error);
            return true;
        }
    }
}

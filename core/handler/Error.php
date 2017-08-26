<?php

set_error_handler("errorHandler");
register_shutdown_function("shutdownHandler");

function errorHandler($error_level, $error_message, $error_file, $error_line, $error_context)
{
    $tipe = "";
    $error = "lvl: " . $error_level . " | msg:" . $error_message . " | file:" . $error_file . " | line:" . $error_line;
    switch ($error_level) {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_PARSE:
            $tipe = "FATAL!!";
            break;
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            $tipe = "ERROR!!";
            break;
        case E_WARNING:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
            $tipe = "WARNING!";
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $tipe = "INFO";
            break;
        case E_STRICT:
            $tipe = "DEBUG";
            break;
        default:
            $tipe = "WARNING!";
    }

    mylog($error, $tipe,$error_message);
}

function shutdownHandler()
{
    $lasterror = error_get_last();
    switch ($lasterror['type'])
    {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_PARSE:
            mylog($lasterror, "FATAL!",_parseMessage($lasterror['message']));
    }
}

function mylog($error, $errlvl, $message)
{
    die(require "error.view.php");
}

function _parseMessage($lasterror)
{
    $lasterror = implode("<br><i>Stack trace :",explode("Stack trace:", $lasterror));
    $error = explode("#", $lasterror);
    return implode("</span><br><span style='margin-left:2%'>#", $error)."</span>";
}

<?php

set_error_handler("errorHandler");
register_shutdown_function("shutdownHandler");

function errorHandler($error_level, $error_message, $error_file, $error_line, $error_context)
{
    $error = "lvl: " . $error_level . " | msg:" . $error_message . " | file:" . $error_file . " | line:" . $error_line;
    switch ($error_level) {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_PARSE:
            mylog($error, "FATAL!!",$error_message);
            break;
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            mylog($error, "ERROR!!",$error_message);
            break;
        case E_WARNING:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
            mylog($error, "WARNING!",$error_message);
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            mylog($error, "INFO",$error_message);
            break;
        case E_STRICT:
            mylog($error, "DEBUG",$error_message);
            break;
        default:
            mylog($error, "WARNING!",$error_message);
    }
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
            $error = "[SHUTDOWN] lvl:" . $lasterror['type'] . " | msg:" . $lasterror['message'] . " | file:" . $lasterror['file'] . " | line:" . $lasterror['line'];
            mylog($error, "FATAL!",$lasterror['message']);
    }
}

function mylog($error, $errlvl,$msg)
{
    die(require "error.view.php");
}

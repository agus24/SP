<?php
/**
 * Boot Handler - jalanin boot aplikasi.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

use Core\App;
use Core\Session;
use Core\Auth;
use Core\Database\QueryBuilder;
use Core\Database\Connection;

//--------------------------------------------------------------------------
// Set PHP Error Reporting Options
//--------------------------------------------------------------------------
error_reporting(0);

//--------------------------------------------------------------------------
// Deklarasi Session
//--------------------------------------------------------------------------
session_start();
session_cache_limiter('');

//--------------------------------------------------------------------------
// Load the Composer Autoloader
//--------------------------------------------------------------------------
require 'vendor/autoload.php';

//--------------------------------------------------------------------------
// Load the Error Handler
//--------------------------------------------------------------------------
require "core/handler/Error.php";

//--------------------------------------------------------------------------
// Load the Helper
//--------------------------------------------------------------------------
require 'core/helper.php';


App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

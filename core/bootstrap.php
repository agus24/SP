<?php
/**
 * Bootstrap - untuk menjalankan aplikasi.
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

use Core\App;
use Core\Auth;
use Core\Database\Connection;
use Core\Database\QueryBuilder;
use Core\Provider;
use Core\Session;
use Core\View\View;

//--------------------------------------------------------------------------
// Set PHP Error Reporting Options
//--------------------------------------------------------------------------
error_reporting(0);

//--------------------------------------------------------------------------
// Menjalankan Session
//--------------------------------------------------------------------------
session_start();
session_cache_limiter('');

//--------------------------------------------------------------------------
// Memanggil Autoloader
//--------------------------------------------------------------------------
require 'vendor/autoload.php';

//--------------------------------------------------------------------------
// Memanggil Error Handler
//--------------------------------------------------------------------------
require "core/handler/Error.php";

//--------------------------------------------------------------------------
// Memanggil Helper
//--------------------------------------------------------------------------
require 'core/helper.php';

//--------------------------------------------------------------------------
// Registrasi Config
//--------------------------------------------------------------------------
App::bind('config', require 'config.php');

//--------------------------------------------------------------------------
// Registrasi Database
//--------------------------------------------------------------------------
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

//--------------------------------------------------------------------------
// Registrasi View
//--------------------------------------------------------------------------
App::bind('view', View::instance());

//--------------------------------------------------------------------------
// Set PHP Default Timezone
//--------------------------------------------------------------------------
date_default_timezone_set(App::config('timezone'));
setlocale(LC_TIME, App::config('locale'));

//--------------------------------------------------------------------------
// Menjalankan Service Provider
//--------------------------------------------------------------------------
Provider::init(require 'app/provider.php');
Provider::boot();

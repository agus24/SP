<?php
/**
 * Provider
 *
 * @author Gustiawan Ouwawi - agusx244@gmail.com
 * @version 1.0
 */

namespace Core;

use Core\App;
/**
 * Melakukan pengambilan data dari file provider
 * @var [type]
 */
$providerList = require 'app/provider.php';

foreach($providerList as $provider)
{
    $prov = "\\App\\Provider\\".$provider;
    App::provider(new $prov); //Menjalankan provider
}

<?php

namespace Core;

use Core\App;

$providerList = require 'app/provider.php';

foreach($providerList as $provider)
{
    $prov = "\\App\\Provider\\".$provider;
    App::provider(new $prov);
}

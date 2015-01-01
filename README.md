# VinExplosion API

This API allows you to look up information for a vehicle by providing only the VIN.

*This is not the official API*

### Example Usage: 
```php
<?php

require 'vendor/autoload.php';

// Set your username and password provided by VinExplosion here.
$account = new \VinExplosion\Account('username', 'password');
$lookup = new \VinExplosion\Lookup($account);

// If you prefer to have the response return in XML format uncomment the following method
// $lookup->setResponseType('application/xml');

// By default the response is a JSON string.
$information = $lookup->requestVinInformation('VIN HERE');

$information = json_decode($information);

print '<pre>';
print_r($information);
print '</pre>';
```

### Response
For documentation regarding the response and parameters [click here](http://vinexplosion.com/Docs).

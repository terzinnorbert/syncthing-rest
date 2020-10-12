# Syncthing REST Client

The Client implements the Syncthing provided REST API calls: https://docs.syncthing.net/dev/rest.html  
The v0.x versions provide simple array responses and the v1.x versions have well-documented response objects.

## Install

Array response version:
```
composer require terzinnorbert/syncthing-php:~0.4
```

Object response version:
```
WIP
```

## Usage

```
<?php
require 'vendor/autoload.php';

use SyncthingRest\Client;

$client = Client('http://localhost:8384','abcdabcd');

var_dump($client->getSystemConfig());
```

## Helpers

### convertTime($time)

Converts the syncthing provided time to Carbon time

```
Client::convertTime('2018-05-06T10:21:00.533401659Z');
```
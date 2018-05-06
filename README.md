# Syncthing REST Client

The Client implements the Syncthing provided REST API calls: https://docs.syncthing.net/dev/rest.html

## Install

```
composer require terzinnorbert/syncthing-php
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
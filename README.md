# DateHuman

A lightweight PHP library for **human-readable time differences**, supporting **past and future** and **multiple languages** (English, Hungarian, Italian).

## Installation

```bash
composer require szalayk/datehuman
```

## Usage

```php
<?php
require 'vendor/autoload.php';

use Szalayk\DateHuman\DateHuman;

$dh = new DateHuman('hu');
echo $dh->diff('2025-11-01 14:00:00'); // "2 napja"
echo $dh->diff('2025-11-05 14:00:00'); // "2 nap múlva"

$dh->setLanguage('it');
echo $dh->diff(strtotime('-3 hours'));  // "3 ore fa"
```

## Supported languages

- English (`en`)
- Hungarian (`hu`)
- Italian (`it`)

You can easily add more languages by creating a new file in `src/Lang/` following the same structure.

## License

MIT License © 2025 Krisztián Szalay.

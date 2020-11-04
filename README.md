# WordPress User Last Modified

<a href="https://wordpress.org/" target="_blank">
    <img src="https://img.shields.io/static/v1?label=&message=4.7+-+5.5&color=blue&style=flat-square&logo=wordpress&logoColor=white" alt="WordPress Versions">
</a>
<a href="https://www.php.net/" target="_blank">
    <img src="https://img.shields.io/static/v1?label=&message=5.3+-+7.4&color=777bb4&style=flat-square&logo=php&logoColor=white" alt="PHP Versions">
</a>

A WordPress code library for tracking the user last modified date and time.

## Installation

Install [Composer](https://getcomposer.org/).

In your WordPress plugin or theme directory, run:

```
composer require wp-forge/user-last-modified
```

Make sure you have this line of code in your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';
```

## Usage
How to fetch the user last modified date/time:

```php
<?php

use WP_Forge\UserLastModified;

$user_id = 1;         // The id of the user
$date_format = 'c';   // Any format that DateTime accepts (e.g. U for unix timestamps, c for ISO8601, etc.)

UserLastModified::get( $user_id, $date_format );
```

## Notes
If used within a WordPress plugin or theme, the code will auto-initialize.

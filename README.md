# PhpGhostWall

PhpGhostWall is a Laravel package for monitoring code integrity, alerting on tampering, and sending server information on boot.

## Installation

You can install the package via composer:

```bash
composer require vishalxtyagi/php-ghost-wall
```

## Usage

1. Publish the config file:

```bash
php artisan vendor:publish --provider="Vishalxtyagi\PhpGhostWall\PhpGhostWallServiceProvider"
```

2. Set up your environment variables in `.env`:

```
INTEGRITY_MONITOR_FILE_PATH=app/Providers/AppServiceProvider.php
INTEGRITY_MONITOR_HASH=your_file_hash_here
INTEGRITY_MONITOR_ALERT_ENDPOINT=https://your-alert-endpoint.com
INTEGRITY_MONITOR_ENDPOINT=https://your-monitor-endpoint.com
```

3. The package will automatically start monitoring on application boot.

## Configuration

You can modify the configuration in the published `config/ghostwall.php` file.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [vishaltyagi.sde@gmail.com](mailto:vishaltyagi.sde@gmail.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
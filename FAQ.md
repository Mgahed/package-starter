# Frequently Asked Questions (FAQ)

## General Questions

### What is this package starter for?

This starter template helps you create Laravel packages quickly. It includes a complete package structure with service providers, commands, controllers, models, routes, views, tests, and a configuration script to customize everything for your needs.

### What Laravel versions does this support?

The package starter supports Laravel 10.x and 11.x. It's built to work with PHP 8.2+.

### Can I use this for non-Laravel PHP packages?

While this is optimized for Laravel packages, you can adapt it for general PHP packages by removing Laravel-specific features (service providers, facades, etc.) and keeping the basic PSR-4 structure.

## Setup & Configuration

### How do I configure the package with my own names?

Simply run the configuration script:
```bash
php configure.php
```

The script will guide you through setting up your package name, namespace, author info, and more.

### Can I run the configuration script multiple times?

It's designed to be run once. If you need to reconfigure, you may need to manually adjust some files or start fresh from the original template.

### What if I make a mistake during configuration?

You can manually edit the files or restore from a backup. Key files to check:
- `composer.json` - Package metadata
- `src/Providers/*ServiceProvider.php` - Service provider
- `src/Commands/*Command.php` - Commands
- `config/*.php` - Config files

### Do I need to delete configure.php after setup?

It's recommended to delete the configuration files once setup is complete:
```bash
rm configure.php configure.bat configure.sh
```

## Development

### How do I test my package locally?

1. Create a test Laravel app
2. Add your package path to `composer.json`:
```json
{
    "repositories": [{
        "type": "path",
        "url": "../your-package"
    }],
    "require": {
        "vendor/package": "*"
    }
}
```
3. Run `composer update`

### Why are my changes not reflected in the test app?

Clear caches:
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
composer dump-autoload
```

### How do I add a new command?

1. Create command in `src/Commands/YourCommand.php`
2. Register in service provider:
```php
$this->commands([
    YourCommand::class,
]);
```

### How do I add database migrations?

1. Create migration file in `database/migrations/`
2. Migrations are auto-loaded from the service provider
3. Users run `php artisan migrate` in their app

### How do I add config files?

1. Create config in `config/your-prefix.php`
2. Load in service provider:
```php
$this->mergeConfigFrom(__DIR__.'/../../config/your-prefix.php', 'your-prefix');
```
3. Publish with:
```php
$this->publishes([
    __DIR__.'/../../config/your-prefix.php' => config_path('your-prefix.php'),
], 'your-prefix-config');
```

## Testing

### How do I run tests?

```bash
composer test
```

### How do I add test coverage?

```bash
composer test-coverage
```

### What is Orchestra Testbench?

It's a package that simulates a Laravel application environment for testing packages without needing a full Laravel installation.

### How do I test routes in my package?

```php
public function test_route_works()
{
    $response = $this->get('/your-route');
    $response->assertStatus(200);
}
```

## Publishing

### How do I publish my package to Packagist?

1. Push code to GitHub/GitLab
2. Go to https://packagist.org
3. Click "Submit"
4. Enter repository URL
5. Enable auto-update webhook

### What version should I start with?

Start with `1.0.0` following [Semantic Versioning](https://semver.org):
- MAJOR version for incompatible changes
- MINOR version for backwards-compatible features
- PATCH version for backwards-compatible bug fixes

### How do I handle package versioning?

1. Update version in git tags
2. Update `CHANGELOG.md`
3. Push tags: `git tag v1.0.0 && git push --tags`

### Do I need to manually update Packagist?

If you set up the GitHub webhook, Packagist updates automatically. Otherwise, click "Update" on your package page.

## Common Issues

### "Class not found" error

```bash
composer dump-autoload
```

Make sure your namespace matches your directory structure (PSR-4).

### Service provider not loading

Check `composer.json` has the correct provider in `extra.laravel.providers`.

### Routes not working

1. Check routes are loaded in service provider
2. Clear route cache: `php artisan route:clear`
3. Check route names are unique

### Config not updating

Clear config cache:
```bash
php artisan config:clear
```

### Tests failing

1. Check you have correct dependencies: `composer update`
2. Verify test extends `TestCase`
3. Check database setup in tests

### PHPStan/Pint errors

Update tools:
```bash
composer update --dev
```

Fix code style:
```bash
composer format
```

## Usage

### How do users install my package?

```bash
composer require vendor/package-name
```

### Do users need to register the service provider?

No! Laravel auto-discovers packages. Just make sure your `composer.json` has:
```json
"extra": {
    "laravel": {
        "providers": ["Your\\ServiceProvider"]
    }
}
```

### How do users publish config?

```bash
php artisan vendor:publish --tag="your-prefix-config"
```

### Can I have both API and web routes?

Yes! The package includes both `routes/api.php` and `routes/web.php`. Both are automatically loaded.

### How do I make features optional?

Use config files:
```php
if (config('your-package.feature_enabled')) {
    // Enable feature
}
```

## Best Practices

### Should I include vendor directory?

No, add `vendor/` to `.gitignore` (already done in this starter).

### How detailed should my README be?

Include:
- Installation instructions
- Basic usage examples
- Configuration options
- Available commands
- Contributing guidelines

### Should I write tests first?

TDD (Test-Driven Development) is recommended but not required. At minimum, write tests for all public APIs.

### How do I handle breaking changes?

1. Deprecate features in a minor version
2. Remove in the next major version
3. Document clearly in CHANGELOG
4. Consider using deprecation notices

## Support & Help

### Where can I get help?

- Check the [Laravel Package Development docs](https://laravel.com/docs/packages)
- Read `USAGE.md` for examples
- Check GitHub issues
- Laravel community forums

### How do I report bugs?

Open an issue on GitHub with:
- Clear description
- Steps to reproduce
- Expected vs actual behavior
- Environment details (PHP version, Laravel version)

### Can I contribute?

Yes! Read `CONTRIBUTING.md` for guidelines.

### How do I suggest new features?

Open a GitHub issue with:
- Feature description
- Use case
- Why it would be beneficial
- Possible implementation approach

---

**Still have questions?** Open an issue on GitHub!


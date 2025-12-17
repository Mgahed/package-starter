# Laravel Package Starter

This is a starter template for creating Laravel packages quickly and easily.

## Features

- 🚀 Quick setup with automated configuration script
- 📦 Pre-configured package structure
- 🎯 Service Provider, Commands, Controllers, Models ready
- 🧪 PHPUnit testing setup with Orchestra Testbench
- 🎨 Laravel Pint for code styling
- 📊 Larastan for static analysis
- 🔧 Config, Views, Routes, and Migrations support

## Getting Started

### 1. Create Your Package

Clone or download this starter package:

```bash
git clone https://github.com/mgahed/package-starter.git your-package-name
cd your-package-name
```

### 2. Run Configuration Script

Run the configuration script to customize the package with your information:

**On Windows:**
```bash
configure.bat
```
or
```bash
php configure.php
```

**On Linux/Mac:**
```bash
chmod +x configure.sh
./configure.sh
```
or
```bash
php configure.php
```

The script will prompt you for:
- Author name and email
- Vendor name (for Composer)
- Package name
- Namespace
- Class name prefix
- Config file prefix
- Command signature

### 3. Install Dependencies

```bash
composer install
```

### 4. Update Autoloader

```bash
composer dump-autoload
```

## What Gets Configured?

The configuration script will automatically:

- ✅ Update `composer.json` with your package details
- ✅ Replace all namespace references
- ✅ Rename service provider, commands, controllers, and models
- ✅ Update config file names and prefixes
- ✅ Update route references
- ✅ Replace author information
- ✅ Update command signatures

## Package Structure

```
├── config/
│   └── mgahed-starter.php          # Package configuration file
├── resources/
│   └── views/
│       └── index.blade.php         # Package views
├── src/
│   ├── Commands/
│   │   └── MgahedStarterCommand.php    # Artisan commands
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── MgahedStarterController.php
│   │   └── Resources/
│   │       └── MgahedStarterResource.php
│   ├── Models/
│   │   └── Mgahed.php              # Package models
│   ├── Providers/
│   │   └── MgahedStarterServiceProvider.php
│   └── Routes/
│       ├── api.php                 # API routes
│       └── web.php                 # Web routes
├── tests/
│   ├── ExampleTest.php
│   └── TestCase.php
├── composer.json
├── configure.php                   # Configuration script
├── configure.bat                   # Windows configuration helper
└── configure.sh                    # Unix/Linux configuration helper
```

## Development

### Running Tests

```bash
composer test
```

### Code Style

Fix code style with Laravel Pint:

```bash
vendor/bin/pint
```

### Static Analysis

Run static analysis with Larastan:

```bash
vendor/bin/phpstan analyse
```

## Using Your Package

### In a Laravel Application

1. Add your package to a Laravel project via Composer:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../your-package-name"
        }
    ]
}
```

2. Require the package:

```bash
composer require your-vendor/your-package-name
```

3. Publish configuration (optional):

```bash
php artisan vendor:publish --tag="your-package-config"
```

4. Publish views (optional):

```bash
php artisan vendor:publish --tag="your-package-views"
```

## Publishing to Packagist

1. Push your code to GitHub
2. Go to [Packagist.org](https://packagist.org)
3. Submit your package URL
4. Set up auto-update webhook in GitHub

## License

MIT License. See LICENSE file for details.

## Documentation

- 📖 [Quick Start Guide](QUICKSTART.md) - Get started in 5 minutes
- 📚 [Usage Guide](USAGE.md) - Comprehensive usage examples
- ❓ [FAQ](FAQ.md) - Frequently asked questions
- 🤝 [Contributing](CONTRIBUTING.md) - Contribution guidelines
- 📝 [Changelog](CHANGELOG.md) - Version history

## Scripts & Commands

### Composer Scripts

```bash
composer configure    # Run configuration script
composer test         # Run tests
composer test-coverage # Run tests with coverage
composer format       # Format code with Pint
composer analyse      # Run static analysis
```

### Make Commands (Unix/Linux/Mac)

```bash
make help            # Show all commands
make configure       # Run configuration
make install         # Install dependencies
make test           # Run tests
make format         # Format code
make analyse        # Run static analysis
make all            # Run format, analyse, and test
```

## Credits

Created by [Abdelrhman Mgahed](https://github.com/mgahed)

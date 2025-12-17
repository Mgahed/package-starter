# Quick Setup Guide

Get your Laravel package up and running in 5 minutes!

## Prerequisites

- PHP 8.2 or higher
- Composer installed
- Git (optional but recommended)

## Step-by-Step Setup

### Step 1: Get the Starter Package

**Option A: Clone with Git**
```bash
git clone https://github.com/mgahed/package-starter.git my-awesome-package
cd my-awesome-package
rm -rf .git  # Remove the original git history
git init     # Start fresh
```

**Option B: Download ZIP**
- Download the package
- Extract to your desired location
- Navigate to the directory

### Step 2: Run Configuration

**Windows Users:**
```bash
configure.bat
```

**Mac/Linux Users:**
```bash
chmod +x configure.sh
./configure.sh
```

**Or use PHP directly:**
```bash
php configure.php
```

### Step 3: Answer the Prompts

The script will ask you for:

1. **Author name** - Your full name (e.g., "John Doe")
2. **Author email** - Your email (e.g., "john@example.com")
3. **Author username** - GitHub/Composer username (e.g., "johndoe")
4. **Vendor name** - Usually same as username (e.g., "johndoe")
5. **Package name** - Your package name (e.g., "my-awesome-package")
6. **Class name** - PHP class prefix (e.g., "MyAwesomePackage")
7. **Namespace** - PSR-4 namespace (e.g., "JohnDoe\\MyAwesomePackage")
8. **Config prefix** - Config file prefix (e.g., "my-awesome-package")
9. **Command signature** - Artisan command name (e.g., "my-awesome")

### Step 4: Install Dependencies

```bash
composer install
```

### Step 5: Verify Setup

Run the test suite:
```bash
composer test
```

Format code:
```bash
composer format
```

Run static analysis:
```bash
composer analyse
```

## What Happened?

The configuration script:
- ✅ Updated all namespaces in your package
- ✅ Renamed all files to match your package name
- ✅ Updated composer.json with your details
- ✅ Configured service providers, commands, controllers
- ✅ Updated routes and views
- ✅ Set up config files with your prefix

## Next Steps

### 1. Test Locally

Create a test Laravel application:
```bash
cd ..
composer create-project laravel/laravel test-app
cd test-app
```

Add your package to `composer.json`:
```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../my-awesome-package"
        }
    ],
    "require": {
        "your-vendor/your-package": "*"
    }
}
```

Install:
```bash
composer update
```

Test your command:
```bash
php artisan your-command-signature
```

Visit your route:
```
http://localhost:8000/your-prefix
```

### 2. Customize Your Package

Start building features:
- Edit `src/Commands/YourCommand.php` for CLI commands
- Edit `src/Http/Controllers/YourController.php` for web endpoints
- Edit `src/Models/YourModel.php` for database models
- Add routes in `src/Routes/web.php` and `src/Routes/api.php`
- Create views in `resources/views/`
- Add config in `config/your-prefix.php`

### 3. Write Tests

Add tests in `tests/`:
```php
<?php

namespace YourNamespace\Tests;

class FeatureTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $this->assertTrue(true);
    }
}
```

Run tests:
```bash
composer test
```

### 4. Update Documentation

- Update `README.md` with your package details
- Document features in `USAGE.md`
- Update `CHANGELOG.md` with changes

### 5. Initialize Git

```bash
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/your-username/your-package.git
git push -u origin main
```

### 6. Publish to Packagist

1. Push to GitHub
2. Go to https://packagist.org
3. Click "Submit"
4. Enter your GitHub repository URL
5. Click "Check"
6. Enable auto-update hook

### 7. Clean Up

Remove the configuration script:
```bash
rm configure.php configure.bat configure.sh
```

Or keep them if you want others to fork your package!

## Common Issues

### "PHP is not recognized"
- Make sure PHP is installed and in your PATH
- Try: `php -v` to verify

### "Class not found" errors
```bash
composer dump-autoload
```

### Routes not working in test app
```bash
php artisan route:clear
php artisan cache:clear
```

### Config not updating
```bash
php artisan config:clear
```

## Getting Help

- Check `USAGE.md` for detailed usage examples
- Read `CONTRIBUTING.md` if you want to contribute
- Open an issue on GitHub
- Check Laravel's [Package Development docs](https://laravel.com/docs/packages)

## Quick Reference

```bash
# Run configuration
composer configure

# Run tests
composer test

# Format code
composer format

# Static analysis
composer analyse

# Test in Laravel app
php artisan your-command

# Publish config
php artisan vendor:publish --tag="your-prefix-config"

# Publish views
php artisan vendor:publish --tag="your-prefix-views"
```

---

🎉 **Congratulations!** Your package is ready to go!

Happy coding!


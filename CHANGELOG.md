# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Automated configuration script (`configure.php`)
- Windows batch script (`configure.bat`) for easy setup
- Unix/Linux bash script (`configure.sh`) for easy setup
- Comprehensive documentation (README.md, USAGE.md)
- Service Provider with auto-discovery
- Command example
- Controller example
- Model example with SoftDeletes
- API Resource example
- Web and API routes
- Config file structure
- Views with Blade templates
- PHPUnit testing setup with Orchestra Testbench
- Laravel Pint for code formatting
- Larastan for static analysis
- MIT License

## [1.0.0] - 2025-12-17

### Added
- Initial release of Laravel Package Starter
- Basic package structure
- Service provider setup
- Example components (Command, Controller, Model, Resource)
- Testing infrastructure
- Code quality tools (Pint, Larastan)
- Configuration system
- Auto-discovery support

---

## How to Update This Changelog

When you make changes to your package:

1. Add entries under `[Unreleased]` section
2. Use subsections: `Added`, `Changed`, `Deprecated`, `Removed`, `Fixed`, `Security`
3. When releasing a version, create a new version section with the date
4. Move unreleased changes to the new version section
5. Update the version in `composer.json`

Example:
```
## [1.1.0] - 2025-12-20

### Added
- New feature X
- Support for Y

### Fixed
- Bug with Z
```


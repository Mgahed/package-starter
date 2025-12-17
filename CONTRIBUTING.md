# Contributing to This Package

Thank you for considering contributing to this package! This document outlines the process for contributing.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check existing issues. When creating a bug report, include:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples** (code snippets, screenshots)
- **Describe the behavior you observed and expected**
- **Include your environment details** (PHP version, Laravel version, OS)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion:

- **Use a clear and descriptive title**
- **Provide a detailed description of the suggested enhancement**
- **Explain why this enhancement would be useful**
- **List any alternatives you've considered**

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Make your changes** following the code style guidelines
3. **Write or update tests** for your changes
4. **Update documentation** if needed
5. **Run the test suite** to ensure everything passes
6. **Submit a pull request**

## Development Process

### Setup Development Environment

1. Clone the repository:
```bash
git clone https://github.com/your-username/package-name.git
cd package-name
```

2. Install dependencies:
```bash
composer install
```

3. Run tests to ensure everything works:
```bash
composer test
```

### Making Changes

1. Create a new branch:
```bash
git checkout -b feature/your-feature-name
```

2. Make your changes following PSR-12 coding standards

3. Write tests for your changes:
```php
/** @test */
public function it_does_something_useful()
{
    // Arrange
    $expected = 'result';
    
    // Act
    $actual = $this->yourMethod();
    
    // Assert
    $this->assertEquals($expected, $actual);
}
```

4. Run tests:
```bash
composer test
```

5. Format your code:
```bash
composer format
```

6. Run static analysis:
```bash
composer analyse
```

### Commit Messages

Write clear and meaningful commit messages:

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally

Good examples:
```
Add user authentication feature

Fix bug in payment processing
- Resolve issue with decimal rounding
- Add test coverage
- Update documentation

Closes #123
```

## Code Style Guidelines

This project follows PSR-12 coding standards. Key points:

### PHP Standards

- Use PHP 8.2+ features when appropriate
- Type hint method parameters and return types
- Use strict types: `declare(strict_types=1);`
- Add PHPDoc blocks for all public methods

Example:
```php
<?php

declare(strict_types=1);

namespace YourNamespace;

class YourClass
{
    /**
     * Process the given data.
     *
     * @param array<string, mixed> $data
     * @return bool
     */
    public function process(array $data): bool
    {
        // Implementation
    }
}
```

### Laravel Conventions

- Follow Laravel naming conventions
- Use Eloquent best practices
- Use dependency injection
- Follow SOLID principles

### Testing

- Write tests for all new features
- Aim for high test coverage (>80%)
- Use descriptive test method names
- Follow Arrange-Act-Assert pattern

## Documentation

- Update README.md if you change functionality
- Update USAGE.md for new features
- Add inline comments for complex logic
- Update CHANGELOG.md following Keep a Changelog format

## Review Process

1. All pull requests require at least one review
2. CI must pass (tests, code style, static analysis)
3. Documentation must be updated
4. Changelog must be updated

## Code of Conduct

### Our Pledge

We are committed to providing a welcoming and inspiring community for all.

### Our Standards

**Positive behavior includes:**
- Using welcoming and inclusive language
- Being respectful of differing viewpoints
- Gracefully accepting constructive criticism
- Focusing on what is best for the community

**Unacceptable behavior includes:**
- Harassment of any kind
- Trolling or insulting/derogatory comments
- Public or private harassment
- Publishing others' private information

## Questions?

Feel free to open an issue for any questions or concerns!

---

Thank you for contributing! 🎉


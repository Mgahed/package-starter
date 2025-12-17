#!/usr/bin/env php
<?php

/**
 * Package Starter Configuration Script
 *
 * This script helps you configure the package starter with your own names and namespaces.
 * Run: php configure.php
 */

function ask(string $question, string $default = ''): string
{
    $answer = readline($question . ($default ? " [{$default}]" : '') . ': ');

    if (! $answer) {
        return $default;
    }

    return $answer;
}

function confirm(string $question, bool $default = false): bool
{
    $answer = ask($question . ' (yes/no)', $default ? 'yes' : 'no');

    return strtolower($answer) === 'yes' || strtolower($answer) === 'y';
}

function writeln(string $line): void
{
    echo $line . PHP_EOL;
}

function run(string $command): string
{
    return trim((string) shell_exec($command));
}

function str_after(string $subject, string $search): string
{
    $pos = strrpos($subject, $search);

    if ($pos === false) {
        return $subject;
    }

    return substr($subject, $pos + strlen($search));
}

function slugify(string $subject): string
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $subject), '-'));
}

function title_case(string $subject): string
{
    return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $subject)));
}

function replace_in_file(string $file, array $replacements): void
{
    $contents = file_get_contents($file);

    file_put_contents(
        $file,
        str_replace(
            array_keys($replacements),
            array_values($replacements),
            $contents
        )
    );
}

function remove_prefix(string $prefix, string $content): string
{
    if (str_starts_with($content, $prefix)) {
        return substr($content, strlen($prefix));
    }

    return $content;
}

function remove_composer_deps(array $names)
{
    $data = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);

    foreach ($data['require-dev'] as $name => $version) {
        if (in_array($name, $names)) {
            unset($data['require-dev'][$name]);
        }
    }

    file_put_contents(__DIR__ . '/composer.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

function remove_composer_script($scriptName)
{
    $data = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);

    if (isset($data['scripts'][$scriptName])) {
        unset($data['scripts'][$scriptName]);
    }

    file_put_contents(__DIR__ . '/composer.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

function determineSeparator(string $path): string
{
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
}

function replaceForWindows(): array
{
    return preg_split('/\\r\\n|\\r|\\n/', run('dir /S /B * | findstr /v /i .git\ | findstr /v /i vendor | findstr /v /i configure.php | findstr /v /i composer.lock'));
}

function replaceForAllOtherOSes(): array
{
    return explode(PHP_EOL, run('grep -E -r -l -i "Mgahed|mgahed|MgahedStarter|mgahed-starter" --exclude-dir=vendor --exclude-dir=.git --exclude=configure.php --exclude=composer.lock .'));
}

writeln('');
writeln('╔═══════════════════════════════════════════════════╗');
writeln('║   Laravel Package Starter Configuration Tool     ║');
writeln('╚═══════════════════════════════════════════════════╝');
writeln('');

writeln('This script will help you configure your new package.');
writeln('');

$git_name = run('git config user.name');
$author_name = ask('Author name', $git_name);

$git_email = run('git config user.email');
$author_email = ask('Author email', $git_email);

$author_username = ask('Author username (for GitHub/composer)', slugify($author_name));
$author_vendor = ask('Vendor name (for composer)', $author_username);

$current_package = 'package-starter';
$package_name = ask('Package name', $current_package);
$package_slug = slugify($package_name);
$package_slug_without_prefix = $package_slug;

$class_name = title_case($package_name);
$class_name = ask('Class name', $class_name);
$package_description = ask('Package description', 'This is my package ' . $package_slug);

$current_namespace = 'Mgahed\\MgahedStarter';
$namespace = ask('Namespace (PSR-4)', $author_vendor . '\\' . $class_name);

$current_prefix = 'mgahed-starter';
$config_prefix = ask('Config prefix (for config file and publishes)', $package_slug);

$current_command_signature = 'test-starter';
$command_signature = ask('Command signature', $package_slug);

writeln('');
writeln('------');
writeln("Author            : {$author_name} ({$author_username}, {$author_email})");
writeln("Vendor            : {$author_vendor}");
writeln("Package           : {$package_slug}");
writeln("Namespace         : {$namespace}");
writeln("Class name        : {$class_name}");
writeln("Config prefix     : {$config_prefix}");
writeln("Command signature : {$command_signature}");
writeln('------');
writeln('');

writeln('This script will replace the above values in all relevant files in the project directory.');

if (! confirm('Modify files?', true)) {
    exit(1);
}

$files = (str_starts_with(strtoupper(PHP_OS), 'WIN') ? replaceForWindows() : replaceForAllOtherOSes());

foreach ($files as $file) {
    $file = trim($file);

    if (empty($file) || is_dir($file)) {
        continue;
    }

    $replacements = [
        'Mgahed\\MgahedStarter' => $namespace,
        'Mgahed\\\\MgahedStarter' => str_replace('\\', '\\\\', $namespace),
        'mgahed/package-starter' => $author_vendor . '/' . $package_slug,
        'Abdelrhman Mgahed' => $author_name,
        'abdelrhman@mgahed.com' => $author_email,
        'mgahed' => $author_username,
        'MgahedStarter' => $class_name,
        'mgahed-starter' => $config_prefix,
        'test-starter' => $command_signature,
        'Mgahed Starter' => ucwords(str_replace('-', ' ', $package_name)),
        'This is my package test-starter' => $package_description,
        'https://github.com/mgahed/package-starter' => '',
    ];

    replace_in_file($file, $replacements);
}

writeln('Files updated successfully!');
writeln('');

// Rename files
$filesToRename = [
    'src/Commands/MgahedStarterCommand.php' => "src/Commands/{$class_name}Command.php",
    'src/Http/Controllers/MgahedStarterController.php' => "src/Http/Controllers/{$class_name}Controller.php",
    'src/Http/Resources/MgahedStarterResource.php' => "src/Http/Resources/{$class_name}Resource.php",
    'src/Providers/MgahedStarterServiceProvider.php' => "src/Providers/{$class_name}ServiceProvider.php",
    'src/Models/Mgahed.php' => "src/Models/" . rtrim($class_name, 's') . ".php",
    "config/mgahed-starter.php" => "config/{$config_prefix}.php",
];

foreach ($filesToRename as $old => $new) {
    $oldPath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $old);
    $newPath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $new);

    if (file_exists($oldPath)) {
        rename($oldPath, $newPath);
        writeln("Renamed: {$old} -> {$new}");
    }
}

writeln('');
writeln('Configuration complete!');
writeln('');
writeln('Next steps:');
writeln('  1. Review the generated files');
writeln('  2. Run: composer install');
writeln('  3. Run: composer dump-autoload');
writeln('  4. Update your README.md with package documentation');
writeln('  5. Delete configure.php when you\'re done');
writeln('');
writeln('Happy coding! 🚀');
writeln('');


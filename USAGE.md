# Package Usage Guide

After running the configuration script, here's how to use and extend your package.

## Quick Start

### 1. Install in a Laravel Project

Add to your Laravel project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../path-to-your-package"
        }
    ],
    "require": {
        "your-vendor/your-package": "*"
    }
}
```

Run:
```bash
composer update
```

### 2. Service Provider Auto-Discovery

Laravel will automatically discover your service provider. No manual registration needed!

### 3. Publish Assets

Publish configuration:
```bash
php artisan vendor:publish --tag="your-prefix-config"
```

Publish views:
```bash
php artisan vendor:publish --tag="your-prefix-views"
```

Publish assets:
```bash
php artisan vendor:publish --tag="your-prefix-assets"
```

## Package Components

### Commands

Your package includes a command that can be run:

```bash
php artisan your-command-signature
```

To customize the command, edit `src/Commands/YourCommand.php`:

```php
<?php

namespace YourNamespace\Commands;

use Illuminate\Console\Command;

class YourCommand extends Command
{
    public $signature = 'your-command {argument} {--option}';
    
    public $description = 'Your command description';
    
    public function handle(): int
    {
        $argument = $this->argument('argument');
        $option = $this->option('option');
        
        $this->info('Command executed!');
        
        return self::SUCCESS;
    }
}
```

### Controllers

Access the controller route at:
```
http://your-app.test/your-prefix
```

Customize in `src/Http/Controllers/YourController.php`:

```php
<?php

namespace YourNamespace\Http\Controllers;

use Illuminate\Routing\Controller;

class YourController extends Controller
{
    public function index()
    {
        return view('your-prefix::index', [
            'data' => 'Hello from your package!'
        ]);
    }
    
    public function store(Request $request)
    {
        // Handle form submission
    }
}
```

### Models

Use your package models in any Laravel project:

```php
use YourNamespace\Models\YourModel;

$model = YourModel::create([
    'name' => 'Example',
]);

$models = YourModel::all();
```

Add relationships, scopes, and methods:

```php
<?php

namespace YourNamespace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YourModel extends Model
{
    protected $fillable = ['name', 'description'];
    
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    public function items(): HasMany
    {
        return $this->hasMany(RelatedModel::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
```

### Routes

#### Web Routes
Edit `src/Routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use YourNamespace\Http\Controllers\YourController;

Route::prefix('your-prefix')->group(function () {
    Route::get('/', [YourController::class, 'index'])->name('your-prefix.index');
    Route::post('/', [YourController::class, 'store'])->name('your-prefix.store');
    Route::get('/{id}', [YourController::class, 'show'])->name('your-prefix.show');
});
```

#### API Routes
Edit `src/Routes/api.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use YourNamespace\Http\Controllers\Api\YourApiController;

Route::prefix('api/your-prefix')->group(function () {
    Route::get('/', [YourApiController::class, 'index']);
    Route::post('/', [YourApiController::class, 'store']);
});
```

### Views

Create Blade views in `resources/views/`:

```blade
{{-- resources/views/index.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('your-prefix.title') }}</title>
</head>
<body>
    <h1>Welcome to Your Package</h1>
    <p>{{ $data }}</p>
</body>
</html>
```

Access views from controllers:
```php
return view('your-prefix::index', ['data' => $data]);
```

### Configuration

Edit `config/your-prefix.php`:

```php
<?php

return [
    'enabled' => env('YOUR_PREFIX_ENABLED', true),
    
    'title' => 'Your Package Title',
    
    'options' => [
        'cache_enabled' => true,
        'cache_duration' => 3600,
    ],
    
    'providers' => [
        // List of provider classes
    ],
];
```

Access config values:
```php
$enabled = config('your-prefix.enabled');
$title = config('your-prefix.title');
```

### Migrations

Create migrations in `database/migrations/`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('your_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('your_table');
    }
};
```

Run migrations:
```bash
php artisan migrate
```

### Resources (API)

Create API resources in `src/Http/Resources/`:

```php
<?php

namespace YourNamespace\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YourResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at->toISOString(),
            'links' => [
                'self' => route('your-prefix.show', $this->id),
            ],
        ];
    }
}
```

Use in controllers:
```php
use YourNamespace\Http\Resources\YourResource;

public function show($id)
{
    $model = YourModel::findOrFail($id);
    return new YourResource($model);
}

public function index()
{
    $models = YourModel::paginate();
    return YourResource::collection($models);
}
```

## Testing

### Write Tests

Create tests in `tests/`:

```php
<?php

namespace YourNamespace\Tests;

use YourNamespace\Models\YourModel;

class YourModelTest extends TestCase
{
    /** @test */
    public function it_can_create_a_model()
    {
        $model = YourModel::create([
            'name' => 'Test Model',
        ]);
        
        $this->assertDatabaseHas('your_table', [
            'name' => 'Test Model',
        ]);
    }
    
    /** @test */
    public function it_can_update_a_model()
    {
        $model = YourModel::factory()->create();
        
        $model->update(['name' => 'Updated']);
        
        $this->assertEquals('Updated', $model->fresh()->name);
    }
}
```

### Run Tests

```bash
composer test
```

With coverage:
```bash
composer test-coverage
```

## Advanced Usage

### Facades

Create a facade for your package:

```php
<?php

namespace YourNamespace\Facades;

use Illuminate\Support\Facades\Facade;

class YourPackage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'your-package';
    }
}
```

Register in service provider:
```php
$this->app->singleton('your-package', function ($app) {
    return new YourPackageService();
});
```

Use in code:
```php
use YourNamespace\Facades\YourPackage;

YourPackage::doSomething();
```

### Events

Create events and listeners:

```php
<?php

namespace YourNamespace\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelCreated
{
    use Dispatchable, SerializesModels;
    
    public function __construct(public $model)
    {
    }
}
```

Dispatch events:
```php
event(new ModelCreated($model));
```

### Middleware

Create middleware:

```php
<?php

namespace YourNamespace\Http\Middleware;

use Closure;

class YourMiddleware
{
    public function handle($request, Closure $next)
    {
        // Do something before request
        
        $response = $next($request);
        
        // Do something after request
        
        return $response;
    }
}
```

Register in service provider:
```php
$router = $this->app['router'];
$router->aliasMiddleware('your-middleware', YourMiddleware::class);
```

## Best Practices

1. **Use namespaces consistently** - Follow PSR-4 autoloading standards
2. **Write tests** - Aim for high test coverage
3. **Document everything** - Add PHPDoc comments to all public methods
4. **Follow Laravel conventions** - Use Laravel's patterns and practices
5. **Version your package** - Use semantic versioning (semver.org)
6. **Keep dependencies minimal** - Only require what's necessary
7. **Use configuration** - Make your package configurable
8. **Publish selectively** - Only publish what users need to customize

## Troubleshooting

### Autoload issues
```bash
composer dump-autoload
```

### Service provider not loading
Check `composer.json` extra.laravel.providers section

### Routes not working
Clear route cache:
```bash
php artisan route:clear
```

### Config not updating
Clear config cache:
```bash
php artisan config:clear
```

## Resources

- [Laravel Package Development Docs](https://laravel.com/docs/packages)
- [Spatie Package Tools](https://github.com/spatie/laravel-package-tools)
- [Orchestra Testbench](https://github.com/orchestral/testbench)

---

Happy package development! 🎉


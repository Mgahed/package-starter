<?php

namespace Mgahed\MgahedStarter\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Mgahed\MgahedStarter\Providers\MgahedStarterServiceProvider;

class TestCase extends Orchestra
{
	protected function setUp(): void
	{
		parent::setUp();
	}

	protected function getPackageProviders($app)
	{
		return [
			MgahedStarterServiceProvider::class,
		];
	}

	public function getEnvironmentSetUp($app)
	{
		config()->set('database.default', 'testing');
	}
}
